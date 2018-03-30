package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class MyEventsRequest extends StringRequest {

    private static final String MY_EVENT_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/My_Events.php";
    private Map<String, String> params;

    public MyEventsRequest(String OrganizationID, Response.Listener<String> listener){
        super(Method.POST, MY_EVENT_REQUEST_URL, listener, null);
        params = new HashMap<String, String>();
        params.put("OrganizationID", OrganizationID);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}