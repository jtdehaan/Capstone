package com.example.android.medconnect;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class TakeSurveyRequest extends StringRequest{
    private static final String UPDATE_SURVEY_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/InsertAnswer.php";
    private Map<String, String> params;

    public TakeSurveyRequest(String SurveyID, String q1, String q2, String q3, String q4, String q5, String PatientID, Response.Listener<String> listener){
        super(Request.Method.POST, UPDATE_SURVEY_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("SurveyID", SurveyID);
        params.put("PatientID", PatientID);
        params.put("q1", q1);
        params.put("q2", q2);
        params.put("q3", q3);
        params.put("q4", q4);
        params.put("q5", q5);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}