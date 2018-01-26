package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class RegisterPatientRequest extends StringRequest {

    private static final String REGISTER_PATIENT_REQUEST_URL = "http://cgi.soic.indiana.edu/~toradze/Register3.php";
    private Map<String, String> params;

    public RegisterPatientRequest(String username, String password, String name, String email, Response.Listener<String> listener){
        super(Method.POST, REGISTER_PATIENT_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("username", username);
        params.put("email", email);
        params.put("password", password);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}