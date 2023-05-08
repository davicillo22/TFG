import pandas as pd
import pickle
import json
# Cargar los modelos entrenados
with open('lr_tnm2.pickle', 'rb') as f:
    lr_modelDic = pickle.load(f)
    lr_model=lr_modelDic['model']

with open('rf_tnm2.pickle', 'rb') as f:
    rf_modelDic = pickle.load(f)
    rf_model=rf_modelDic['model']

def predict_probabilities(model, patient_data):
    proba = model.predict_proba(patient_data)
    return proba[0][1]

# Datos de un nuevo paciente como un DataFrame con las mismas columnas que X_train_post
new_patient_post = pd.read_csv('dataPatient.csv')
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TRBQ', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
new_patient_post = new_patient_post[selected_features_post]
# Predicciones de probabilidad para ambos modelos
lr_probability = predict_probabilities(lr_model, new_patient_post)
rf_probability = predict_probabilities(rf_model, new_patient_post)

result = {
    "lr_probability": lr_probability,
    "rf_probability": rf_probability,
    
    "precisionLR": lr_modelDic['precision'],
    "recallLR": lr_modelDic['recall'],
    "f1LR": lr_modelDic['f1_score'],
    "accuracyLR": lr_modelDic['accuracy'],

    "precisionRF": rf_modelDic['precision'],
    "recallRF": rf_modelDic['recall'],
    "f1RF": rf_modelDic['f1_score'],
    "accuracyRF": rf_modelDic['accuracy']
}

print(json.dumps(result))