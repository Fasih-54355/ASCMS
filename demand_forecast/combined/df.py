import pandas as pd
from pmdarima import auto_arima
import plotly.graph_objs as go
from sklearn.metrics import mean_squared_error, mean_absolute_error
import logging
import os

# Initialize logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# Correct file path
file_path = 'C:/xampp/htdocs/ascms/demand_forecast/combined/Demand Forcast.csv'

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

current_folder = os.path.dirname(os.path.realpath(__file__))

# Process the demand data
demand_data = preprocess_demand_data(file_path)
if demand_data is not None:
    model = train_auto_arima_model(demand_data)
    if model is not None:
        # Forecasting for 12 months ahead
        forecast_length = 12
        forecast = model.predict(n_periods=forecast_length)
        forecast_index = pd.date_range(start=demand_data.index[-1] + pd.offsets.MonthEnd(1), periods=forecast_length, freq='M')

        # Model Evaluation - Splitting data into train and test
        split_point = int(len(demand_data) * 0.8)
        train, test = demand_data[0:split_point], demand_data[split_point:]
        test_forecast = model.predict(n_periods=len(test))

        # Calculate metrics
        mse = mean_squared_error(test, test_forecast)
        mae = mean_absolute_error(test, test_forecast)
        logging.info(f'MSE: {mse}, MAE: {mae}')

        # Creating the interactive plot with Plotly
        fig = go.Figure()
        fig.add_trace(go.Scatter(x=demand_data.index, y=demand_data, mode='lines', name='Actual Demand'))
        fig.add_trace(go.Scatter(x=forecast_index, y=forecast, mode='lines', name='Forecasted Demand'))

        fig.update_layout(title='Demand Forecast', xaxis_title='Date', yaxis_title='Demand', hovermode='x')
    # Save the plot as an HTML file in the current folder
        file_name = 'demand_forecast.html'
        fig.write_html(os.path.join(current_folder, file_name))
        logging.info(f'Plot saved as HTML in the current folder: {file_name}')
else:
    print("Unable to process the demand data.")
