package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class PatientEventsRegisterRequest extends StringRequest {

    private static final String PATIENT_EVENTS_REGISTER_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Events_Register.php";
    private Map<String, String> params;

    public PatientEventsRegisterRequest(String event_id, String patient_id, Response.Listener<String> listener){
        super(Method.POST, PATIENT_EVENTS_REGISTER_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("event_id", event_id);
        params.put("patient_id", patient_id);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}