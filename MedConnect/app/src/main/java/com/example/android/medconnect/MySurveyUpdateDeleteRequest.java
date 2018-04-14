package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class MySurveyUpdateDeleteRequest extends StringRequest {

    private static final String MY_SURVEY_UPDATE_DELETE_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Surveys_Delete.php";
    private Map<String, String> params;

    public MySurveyUpdateDeleteRequest(String SurveyID, Response.Listener<String> listener){
        super(Method.POST, MY_SURVEY_UPDATE_DELETE_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("SurveyID", SurveyID);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}