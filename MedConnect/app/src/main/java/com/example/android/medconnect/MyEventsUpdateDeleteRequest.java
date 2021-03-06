package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class MyEventsUpdateDeleteRequest extends StringRequest {

    private static final String MY_EVENTS_UPDATE_DELETE_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Events_Delete.php";
    private Map<String, String> params;

    public MyEventsUpdateDeleteRequest(String eventID, Response.Listener<String> listener){
        super(Method.POST, MY_EVENTS_UPDATE_DELETE_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("EventID", eventID);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}