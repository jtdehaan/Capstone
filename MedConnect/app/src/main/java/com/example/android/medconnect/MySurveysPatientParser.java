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
 * Created by Jacob on 4/16/2018.
 */


public class MySurveysPatientParser extends AsyncTask<Void, Void, Integer> {

    //Context to be passed to the progress dialog
    Context c;
    //Listview holding the data
    ListView lv;
    //Data read from PHP script
    String jsonData;

    //Show progress of parsing process
    ProgressDialog pd;
    //Array list of Events
    ArrayList<MySurveysDoctor> mySurveys = new ArrayList<MySurveysDoctor>();

    //Constructor
    public MySurveysPatientParser(Context c, ListView lv, String jsonData) {
        this.c = c;
        this.lv = lv;
        this.jsonData = jsonData;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();

        //Initialize progress dialog and display it
        pd = new ProgressDialog(c);
        pd.setTitle("Parser");
        pd.setMessage("Parsing...");
        pd.show();
    }

    @Override
    protected Integer doInBackground(Void... params) {
        //Perform background computation of data parsing process
        return this.parseData();
    }

    @Override
    protected void onPostExecute(Integer result) {
        super.onPostExecute(result);

        //Stop the progress dialog
        pd.dismiss();

        //Notify the user if there is no data to be parsed, otherwise call the adapter
        if (result == 0) {
            Toast.makeText(c, "Unable to retrieve data", Toast.LENGTH_SHORT).show();
            //Call on the adapter to bind the data
            MySurveysPatientAdapter adapter = new MySurveysPatientAdapter(c, mySurveys);
            lv.setAdapter(adapter);
        }
    }

    private int parseData() {
        try {
            //Initialize a JSON array and object to pull data from PHP script
            JSONArray ja = new JSONArray(jsonData);
            JSONObject jo = null;

            //Reset the list in order to add new values
            mySurveys.clear();
            MySurveysDoctor s = null;

            //Loop through the array
            for (int i = 0; i < ja.length(); i++) {
                //Set the object equal to the current position in the array
                jo = ja.getJSONObject(i);

                //Retrieve values from corresponding columns in database
                int id = jo.getInt("SurveyID");
                String name = jo.getString("name");
                String question1 = jo.getString("q1");
                String question2 = jo.getString("q2");
                String question3 = jo.getString("q3");
                String question4 = jo.getString("q4");
                String question5 = jo.getString("q5");
                String surveyID = jo.getString("SurveyID");

                //Set values in the event object
                s = new MySurveysDoctor();
                s.setId(id);
                s.setName(name);
                s.setQuestion1(question1);
                s.setQuestion2(question2);
                s.setQuestion3(question3);
                s.setQuestion4(question4);
                s.setQuestion5(question5);
                s.setSurveyID(surveyID);

                //Add the event object to the array
                mySurveys.add(s);
            }

            return 1;


        } catch (JSONException e) {
            e.printStackTrace();
        }

        return 0;
    }
}
