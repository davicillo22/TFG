import pandas as pd
from datetime import datetime
import numpy as np

# Leer el archivo CSV
data = pd.read_csv('dataPatientPREV.csv')
# Lee el archivo CSV
df = pd.read_csv('data.csv')

# FUSION RBQ Y TRBQ
data.loc[data['RBQ'] == 2, 'TRBQ'] = -1
data = data.drop(columns=['RBQ'])

# ELIMINAR COLUMNAS INUTILES
columns_to_remove = ["NHIS", "ETNIA", "HISTO", "HISTO2", "ILINF", "ILINF2", "IVASCU", "IVASCU2", "RA", "NBIOPSIA", "TSUPERV", "NOTAS", "T1MTX", "RTPMES"]
data.drop(columns_to_remove, axis=1, inplace=True)

# QUITAR VALORES ERRÓNEOS
cols_cat = ["OBESO", "HTA", "DM", "TABACO", "HEREDA", "TACTOR", "GLEASON1", "NCILPOS", "BILAT", "IPERIN", "ECOTR", "TNM1", "GLEASON2", "BILAT2", "LOCALIZ", "MULTIFOC", "EXTRACAP", "VVSS", "IPERIN2", "PINAG", "MARGEN", "TNM2", "RTPADYU", "FALLEC", "PTEN", "ERG", "KI_67", "SPINK1", "C_MYC"]
rangos_cat = {
    "OBESO": [0, 1, 2, 3],
    "HTA": [1, 2],
    "DM": [1, 2],
    "TABACO": [0, 1, 2, 3, 4, 5],
    "HEREDA": [1, 2],
    "TACTOR": [1, 2, 3],
    "GLEASON1": [1, 2, 3, 4, 5],
    "NCILPOS": [1, 2, 3],
    "BILAT": [1, 2],
    "IPERIN": [1, 2],
    "ECOTR": [1, 2],
    "TNM1": [1, 2, 3],
    "GLEASON2": [1, 2, 3, 4, 5],
    "BILAT2": [1, 2],
    "LOCALIZ": [1, 2, 3, 4],
    "MULTIFOC": [1, 2],
    "EXTRACAP": [1, 2],
    "VVSS": [1, 2],
    "IPERIN2": [1, 2],
    "PINAG": [1, 2],
    "MARGEN": [1, 2],
    "TNM2": [1, 2, 3, 5],
    "RTPADYU": [1, 2],
    "FALLEC": [1, 2],
    "PTEN": [0, 1, 2],
    "ERG": [0, 1],
    "KI_67": [0, 1, 2],
    "SPINK1": [0, 1],
    "C_MYC": [0, 1],
}
def detectar_valores_erroneos(col_name, col):
    rangos_permitidos = rangos_cat[col_name]
    return [x for x in col if x not in rangos_permitidos and not pd.isna(x)]

for col_name in data.columns:
    if col_name != 'TRBQ': 
        if col_name in cols_cat:
            valores_erroneos = detectar_valores_erroneos(col_name, data[col_name])
            print(f"Valores erróneos en la columna '{col_name}': {valores_erroneos}")
            data[col_name] = data[col_name].apply(lambda x: np.nan if x in valores_erroneos else x)

# CALCULAR MEDIANA Y SUSTITUIR NULLS POR MEDIANA
medianas = df.median().astype(int)
data.fillna(medianas, inplace=True)

# CAMBIAR LAS FECHAS POR MESES
if( not data['FECHACIR'].isnull().all() and not data['FECHAFIN'].isnull().all()):
    data['FECHACIR'] = pd.to_datetime(data['FECHACIR'], errors='coerce')
    data['FECHAFIN'] = pd.to_datetime(data['FECHAFIN'], errors='coerce')
    reference_date = datetime(2023, 4, 3)
    data['TCIR'] = (((reference_date - data['FECHACIR']).dt.days) / 30.44).round().astype(int)
    data['TFIN'] = (((reference_date - data['FECHAFIN']).dt.days) / 30.44).round().astype(int)

data = data.drop(['FECHACIR', 'FECHAFIN'], axis=1)

# HACER CODIFICACION ONE-HOT
missing_columns = set(df.columns) - set(data.columns)
for column in missing_columns:
    data[column] = 0
    print(column)

cols_catBin = ["OBESO", "TABACO","TACTOR", "GLEASON1", "NCILPOS", "BILAT", "IPERIN", "TNM1", "GLEASON2", "LOCALIZ", "EXTRACAP", "MARGEN", "TNM2", "PTEN"]


data=data.drop(cols_catBin, axis=1)
#DATA_PATIENT LIMPIEZA GLOBAL
data.to_csv("dataPatient.csv", index=False)