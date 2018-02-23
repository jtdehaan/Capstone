package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class AddEventRequest extends StringRequest {

    private static final String ADD_EVENT_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Add_Event_APP.php";
    private Map<String, String> params;

    public AddEventRequest(String EventName, String Location, String Phone, String Email,String Times,String Price, Response.Listener<String> listener){
        super(Method.POST, ADD_EVENT_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("Eventname", EventName);
        params.put("Location", Location);
        params.put("Email", Email);
        params.put("Times", Times);
        params.put("Phone", Phone);
        params.put("Price", Price);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}