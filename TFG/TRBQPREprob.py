import pandas as pd
import pickle
import json
# Cargar los modelos entrenados
with open('cph_pre.pickle', 'rb') as f:
    cphDic = pickle.load(f)
    cph=cphDic['model']

def predict_rbq_probabilities(model, patient_data):
    survival_5_years = model.predict_survival_function(patient_data, times=[60])
    survival_10_years = model.predict_survival_function(patient_data, times=[120])

    rbq_5_years = 1 - survival_5_years.iloc[0, 0]
    rbq_10_years = 1 - survival_10_years.iloc[0, 0]

    return rbq_5_years, rbq_10_years

# Datos de un nuevo paciente como un DataFrame con las mismas columnas que X_train_pre y X_train_post
new_patient_pre = pd.read_csv('dataPatient.csv')
selected_features_pre = ['EDAD', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'PSAPRE', 'PSALT', 'TDUPPRE', 'ECOTR', 'GLEASON1_1', 'GLEASON1_2', 'GLEASON1_3', 'GLEASON1_4', 'GLEASON1_5', 'NCILPOS_1', 'NCILPOS_2', 'NCILPOS_3', 'BILAT', 'PORCENT', 'IPERIN', 'TNM1_1', 'TNM1_2','TNM1_3','TCIR']
new_patient_pre = new_patient_pre[selected_features_pre]

rbq_5_years_pre, rbq_10_years_pre = predict_rbq_probabilities(cph, new_patient_pre)

result = {
    "rbq_5_years_pre": rbq_5_years_pre,
    "rbq_10_years_pre": rbq_10_years_pre,

    "concordance": cphDic['concordancia'],
    "partialAIC": cphDic['partialAIC'],
    "logRatio": cphDic['logRatio']
}

print(json.dumps(result))