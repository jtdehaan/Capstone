package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class DoctorPatientListRequest extends StringRequest {

    private static final String DOCTOR_PATIENT_LIST_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Doctor_Patient.php";
    private Map<String, String> params;

    public DoctorPatientListRequest(String doctor_id, String patient_id, Response.Listener<String> listener){
        super(Method.POST, DOCTOR_PATIENT_LIST_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("doctor_id", doctor_id);
        params.put("patient_id", patient_id);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}