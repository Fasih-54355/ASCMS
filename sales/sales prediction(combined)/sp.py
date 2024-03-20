
import pandas as pd
from statsmodels.tsa.statespace.sarimax import SARIMAX
import plotly.graph_objs as go
import logging
import os

# Initialize logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')


# Number of products
num_products = 1

# Function to preprocess data for demand forecasting
def preprocess_demand_data(file_path):
    if not os.path.exists(file_path):
        logging.error(f'File not found: {file_path}')
        return None

    try:
        data = pd.read_csv(file_path, parse_dates=['date'])
        data['date'] = pd.to_datetime(data['date'], errors='coerce')
        data.dropna(subset=['date', 'units', 'sales'], inplace=True)
        data.set_index('date', inplace=True)
        monthly_data = data.resample('M').sum()  # Summing monthly units and sales
        return monthly_data[['units', 'sales']]
    except Exception as e:
        logging.error(f'Error processing file {file_path}: {e}')
        return None

# Function to train and evaluate SARIMA model for demand forecasting
# Note: This function now needs to be adapted if you want to forecast both units and sales.
# For simplicity, this example will focus on forecasting sales.
def train_sarima_demand_model(demand_data):
    try:
        order = (1, 1, 1)
        seasonal_order = (1, 1, 1, 12)
        model = SARIMAX(demand_data['sales'], order=order, seasonal_order=seasonal_order)
        model_fit = model.fit(disp=False)
        return model_fit
    except Exception as e:
        logging.error(f'Error training SARIMA model: {e}')
        return None
    
current_folder = os.path.dirname(os.path.realpath(__file__))

# Forecasting demand for each product
for i in range(1, num_products + 1):
    file_path = 'C:/xampp/htdocs/ascms/sales/sales prediction(combined)/Sales Forcast.csv'
    monthly_data = preprocess_demand_data(file_path)
    if monthly_data is None:
        continue

    model_fit = train_sarima_demand_model(monthly_data)
    if model_fit is None:
        continue

    forecast_length = 12  # Forecasting for 12 months
    forecast = model_fit.get_forecast(steps=forecast_length)
    forecast_index = pd.date_range(monthly_data.index[-1], periods=forecast_length + 1, freq='M')[1:]
    forecast_values = forecast.predicted_mean

    # Calculate and Log Model Evaluation Metrics
    if len(monthly_data) > forecast_length:
        test_data = monthly_data[-forecast_length:]
        mse = ((test_data['sales'] - forecast_values[:len(test_data)]) ** 2).mean()
        logging.info(f'Product {i} - MSE: {mse}')

    # Plotting the actual and forecasted demand with plotly
    fig = go.Figure()

    # Actual Demand Line (sales)
    fig.add_trace(go.Scatter(
        x=monthly_data.index, y=monthly_data['sales'], mode='lines',
        name='Actual Sales',
        customdata=monthly_data[['units']],
        hovertemplate='Date: %{x}<br>Sales: %{y}<br>Units: %{customdata[0]}<extra></extra>'
    ))

    # Forecasted Demand Line (sales)
    fig.add_trace(go.Scatter(
        x=forecast_index, y=forecast_values, mode='lines',
        name='Forecasted Sales',
        hovertemplate='Date: %{x}<br>Forecasted Sales: %{y:.2f}<extra></extra>'
    ))

    # Adding title and labels
    fig.update_layout(
        title=f'Sales Forecast ',
        xaxis_title='Date',
        yaxis_title='Sales'
    )
    
    file_name = f'product_{i}_sales_forecast.html'
    fig.write_html(os.path.join(current_folder, file_name))
    logging.info(f'Plot saved as HTML in the current folder: {file_name}')