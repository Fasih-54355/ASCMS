import pandas as pd
from pmdarima import auto_arima
import plotly.graph_objs as go
from sklearn.metrics import mean_squared_error, mean_absolute_error
import logging
import os

# Initialize logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# Number of products
num_products = 8

# Function to preprocess data for demand forecasting
def preprocess_demand_data(file_path):
    if not os.path.exists(file_path):
        logging.error(f'File not found: {file_path}')
        return None

    try:
        data = pd.read_csv(file_path, parse_dates=['date'])
        data['date'] = pd.to_datetime(data['date'], errors='coerce')
        data.dropna(subset=['date'], inplace=True)
        data.set_index('date', inplace=True)
        demand_data = data['sales'].resample('M').sum()  # Summing monthly sales for monthly demand
        return demand_data
    except Exception as e:
        logging.error(f'Error processing file {file_path}: {e}')
        return None

# Function to train auto ARIMA model for demand forecasting
def train_auto_arima_model(demand_data, seasonal=True, m=12):
    if demand_data is None:
        return None
    try:
        model = auto_arima(demand_data, seasonal=seasonal, m=m, suppress_warnings=True)
        return model
    except Exception as e:
        logging.error(f'Error training ARIMA model: {e}')
        return None

# Forecasting demand for each product and creating interactive plots
for i in range(1, num_products + 1):
    file_path = os.path.join('c:/xampp/htdocs/ascms/demand_forecast', f'Product{i}.csv')
    demand_data = preprocess_demand_data(file_path)
    if demand_data is None:
        continue

    model = train_auto_arima_model(demand_data)
    if model is None:
        continue

    # Forecasting for 12 months ahead, ensuring the forecast includes December 2023
    last_date = demand_data.index[-1]
    forecast_length = 12
    forecast = model.predict(n_periods=forecast_length)
    forecast_index = pd.date_range(start=last_date + pd.offsets.MonthEnd(1), periods=forecast_length, freq='M')

    # Model Evaluation - Splitting data into train and test
    split_point = int(len(demand_data) * 0.8)
    train, test = demand_data[0:split_point], demand_data[split_point:]
    test_forecast = model.predict(n_periods=len(test))

    # Calculate metrics
    mse = mean_squared_error(test, test_forecast)
    mae = mean_absolute_error(test, test_forecast)
    logging.info(f'Product {i} - MSE: {mse}, MAE: {mae}')

    # Creating the interactive plot with Plotly
    fig = go.Figure()
    fig.add_trace(go.Scatter(x=demand_data.index, y=demand_data, mode='lines', name='Actual Demand'))
    fig.add_trace(go.Scatter(x=forecast_index, y=forecast, mode='lines', name='Forecasted Demand'))

    fig.update_layout(title=f'Demand Forecast for Product {i}', xaxis_title='Date', yaxis_title='Demand', hovermode='x')
    # fig.show()
    # Save the chart as an HTML file
    fig.write_html(f'c:/xampp/htdocs/ascms/demand_forecast/chart_product_{i}.html')

