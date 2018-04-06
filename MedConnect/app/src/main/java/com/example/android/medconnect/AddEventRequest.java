package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class AddEventRequest extends StringRequest {

    private static final String ADD_EVENT_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Add_Event_APP.php";
    private Map<String, String> params;

    public AddEventRequest(String EventName, String Description, String Location, String Times, String Price, String Date, String ID, Response.Listener<String> listener){
        super(Method.POST, ADD_EVENT_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("Eventname", EventName);
        params.put("Description", Description);
        params.put("Location", Location);
        params.put("Times", Times);
        params.put("Price", Price);
        params.put("Date", Date);
        params.put("ID",ID);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}