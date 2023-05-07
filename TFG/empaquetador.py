import pandas as pd

# Cargar los datos de los csv
data = pd.read_csv('data.csv')
data_patient = pd.read_csv('dataPatientNew.csv')

# Crear un nuevo dataframe para la fila que vamos a añadir
new_row = pd.DataFrame(columns=data.columns)

# Añadir los valores correspondientes a los headers
for header in data.columns:
    if header in data_patient.columns:
        new_row[header] = [data_patient[header][0]]
    else:
        new_row[header] = [None]

# Añadir la nueva fila al dataframe original
data = data.append(new_row, ignore_index=True)

# Guardar los cambios en el archivo data.csv
data.to_csv('data.csv', index=False)