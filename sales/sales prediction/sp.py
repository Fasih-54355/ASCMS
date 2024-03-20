import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler
from sklearn.linear_model import LinearRegression
import plotly.graph_objs as go
import plotly.io as pio

# Number of products
num_products = 8

# List to store predicted dataframes for each product
all_predicted_dfs = []

# Loop through each product
for i in range(1, num_products + 1):
    # Read data for the current product
    file_path = 'c:/xampp/htdocs/ascms/sales/sales prediction/Product{}.csv'.format(i)
    warehouse_sales = pd.read_csv(file_path)
    warehouse_sales['Product'] = f'Product {i}'

    # Perform data preprocessing
    warehouse_sales['date'] = pd.to_datetime(warehouse_sales['date'], errors='coerce')
    warehouse_sales['date'] = warehouse_sales['date'].dt.to_period("M")
    monthly_sales = warehouse_sales.groupby(['Product', 'date']).sum().reset_index()
    monthly_sales['sales_diff'] = monthly_sales.groupby('Product')['sales'].diff().fillna(0)

    # Create lag features for time series
    supervised_data = monthly_sales.drop(['date', 'sales'], axis=1)
    for j in range(1, 13):
        col_name = 'month_' + str(j)
        supervised_data[col_name] = supervised_data.groupby('Product')['sales_diff'].shift(j)

    supervised_data = supervised_data.dropna().reset_index(drop=True)

    # Select numeric columns for modeling
    numeric_columns = supervised_data.select_dtypes(include=np.number).columns.tolist()

    # Split data into train and test sets
    train_data = supervised_data[:-12][numeric_columns]
    test_data = supervised_data[-12:][numeric_columns]

    # Scale the data
    scaler = MinMaxScaler(feature_range=(-1, 1))
    scaler.fit(train_data)
    train_data = scaler.transform(train_data)
    test_data = scaler.transform(test_data)

    # Prepare train and test sets for model
    x_train, y_train = train_data[:, 1:], train_data[:, 0:1]
    x_test, y_test = test_data[:, 1:], test_data[:, 0:1]
    y_train = y_train.ravel()
    y_test = y_test.ravel()

    # Initialize and train Linear Regression model
    lr_model = LinearRegression()
    lr_model.fit(x_train, y_train)

    # Make predictions on the test set
    lr_pre = lr_model.predict(x_test)
    lr_pre = lr_pre.reshape(-1, 1)
    lr_pre_test_set = np.concatenate([lr_pre, x_test], axis=1)
    lr_pre_test_set = scaler.inverse_transform(lr_pre_test_set)

    # Create DataFrame for predicted sales
    sales_dates = monthly_sales['date'][-12:].reset_index(drop=True)
    predict_df = pd.DataFrame(sales_dates)
    act_sales = monthly_sales['sales'][-13:].to_list()

    result_list = []
    for index in range(0, len(lr_pre_test_set)):
        result_list.append(lr_pre_test_set[index][0] + act_sales[index])

    lr_pre_series = pd.Series(result_list, name="linear Prediction")
    predict_df = predict_df.merge(lr_pre_series, left_index=True, right_index=True)

    # Store predicted DataFrame for current product
    all_predicted_dfs.append(predict_df)

    # Store predicted DataFrame for current product
    predicted_df = predict_df  # Assuming predict_df is the correct variable name

# Function to generate and display sales forecast plots
def save_sales_forecast_plot(actual_sales, predicted_sales, product_number):
    fig = go.Figure()

    # Add traces for actual sales of each product
    fig.add_trace(go.Scatter(x=actual_sales['date'].astype(str), y=actual_sales['sales'],
                             mode='lines', name=f'Product {product_number} Actual Sales',
                             line=dict(color='blue')))

    # Add traces for predicted sales of each product
    fig.add_trace(go.Scatter(x=predicted_sales['date'].astype(str), y=predicted_sales['linear Prediction'],
                             mode='lines', name=f'Product {product_number} Predicted Sales',
                             line=dict(color='orange')))

    # Graph layout
    layout = go.Layout(
        title=f'Customer Sales Forecast for Product {product_number} using LR Model',
        xaxis=dict(title='Date'),
        yaxis=dict(title='Sales'),
        hovermode='x unified',
        template='plotly_dark'
    )

    fig.update_layout(layout)

    # Save the chart as an HTML file
    file_name = f'Product_{product_number}_Sales_Forecast.html'
    with open(file_name, 'w') as f:
        f.write(pio.to_html(fig, full_html=True))

# Loop through all predicted dataframes and generate/save charts
for i, predicted_df in enumerate(all_predicted_dfs):
    product_number = i + 1
    actual_sales = monthly_sales[monthly_sales['Product'] == f'Product {product_number}']
    save_sales_forecast_plot(actual_sales, predicted_df, product_number)


# Call the function to generate and save the chart for the current product
# generate_sales_forecast_plot(monthly_sales['sales'], predicted_df, i + 1)

# Store predicted DataFrame for current product
# all_predicted_dfs.append(predict_df)