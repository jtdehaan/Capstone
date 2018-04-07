package com.example.android.medconnect;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by Jacob on 4/6/2018.
 */


public class MySurveysDoctorParser extends AsyncTask<Void, Void, Integer> {

    Context c;
    ListView lv;
    String jsonData;

    ProgressDialog pd;
    ArrayList<MySurveysDoctor> mySurveys = new ArrayList<MySurveysDoctor>();

    public MySurveysDoctorParser(Context c, ListView lv, String jsonData) {
        this.c = c;
        this.lv = lv;
        this.jsonData = jsonData;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();

        pd = new ProgressDialog(c);
        pd.setTitle("Parse");
        pd.setMessage("Parsing...Please wait");
        pd.show();
    }

    @Override
    protected Integer doInBackground(Void... params) {
        return this.parseData();
    }

    @Override
    protected void onPostExecute(Integer result) {
        super.onPostExecute(result);

        pd.dismiss();
        if (result == 0) {
            Toast.makeText(c, "Unable to parse", Toast.LENGTH_SHORT).show();
        } else {
            //CALL ADAPTER TO BIND DATA
            MySurveyDoctorAdapter adapter = new MySurveyDoctorAdapter(c, mySurveys);
            lv.setAdapter(adapter);
        }
    }

    private int parseData() {
        try {
            JSONArray ja = new JSONArray(jsonData);
            JSONObject jo = null;

            mySurveys.clear();
            MySurveysDoctor s = null;

            for (int i = 0; i < ja.length(); i++) {
                jo = ja.getJSONObject(i);

                int id = jo.getInt("SurveyID");
                String name = jo.getString("name");
                String question1 = jo.getString("question1");
                String question2 = jo.getString("question2");
                String question3 = jo.getString("question3");
                String question4 = jo.getString("question4");
                String question5 = jo.getString("question5");
                String surveyID = jo.getString("SurveyID");

                s = new MySurveysDoctor();
                s.setId(id);
                s.setName(name);
                s.setQuestion1(question1);
                s.setQuestion2(question2);
                s.setQuestion3(question3);
                s.setQuestion4(question4);
                s.setQuestion5(question5);
                s.setSurveyID(surveyID);

                mySurveys.add(s);
            }

            return 1;


        } catch (JSONException e) {
            e.printStackTrace();
        }

        return 0;
    }
}

