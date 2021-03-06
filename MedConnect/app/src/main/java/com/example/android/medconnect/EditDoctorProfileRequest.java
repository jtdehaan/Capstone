package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class EditDoctorProfileRequest extends StringRequest {

    private static final String EDIT_DOCTOR_PROFILE_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Edit_Doctor.php";
    private Map<String, String> params;

    public EditDoctorProfileRequest(String username, String name, String email, String user_id, Response.Listener<String> listener){
        super(Method.POST, EDIT_DOCTOR_PROFILE_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("username", username);
        params.put("email", email);
        params.put("user_id", user_id);
        // params.put("password", password);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}