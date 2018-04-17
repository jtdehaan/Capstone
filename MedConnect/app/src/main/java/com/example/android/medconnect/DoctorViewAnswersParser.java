package com.example.android.medconnect;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import com.example.android.medconnect.EventsList;
import com.example.android.medconnect.EventsListAdapter;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/21/2018.
 */

public class DoctorViewAnswersParser extends AsyncTask<Void, Void, Integer> {

    //Context to be passed to the progress dialog
    Context c;
    //Listview holding the data
    ListView lv;
    //Data read from PHP script
    String jsonData;

    //Show progress of parsing process
    ProgressDialog pd;
    //Array list of Events
    ArrayList<DoctorViewAnswers> doctorViewAnswers = new ArrayList<>();

    //Constructor
    public DoctorViewAnswersParser(Context c, ListView lv, String jsonData) {
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
        } else {
            //Call on the adapter to bind the data
            DoctorViewAnswersAdapter adapter = new DoctorViewAnswersAdapter(c, doctorViewAnswers);
            lv.setAdapter(adapter);
        }
    }

    private int parseData() {
        try {
            //Initialize a JSON array and object to pull data from PHP script
            JSONArray ja = new JSONArray(jsonData);
            JSONObject jo = null;

            //Reset the list in order to add new values
            doctorViewAnswers.clear();
            DoctorViewAnswers s = null;

            //Loop through the array
            for (int i = 0; i < ja.length(); i++) {

                //Set the object equal to the current position in the array
                jo = ja.getJSONObject(i);

                //Retrieve values from corresponding columns in database
                int id = jo.getInt("AID");
                String surveyID = jo.getString("SurveyID");
                String answer1 = jo.getString("a1");
                String answer2 = jo.getString("a2");
                String answer3 = jo.getString("a3");
                String answer4 = jo.getString("a4");
                String answer5 = jo.getString("a5");

                //Set values in the event object
                s = new DoctorViewAnswers();
                s.setId(id);
                s.setSurveyID(surveyID);
                s.setA1(answer1);
                s.setA2(answer2);
                s.setA3(answer3);
                s.setA4(answer4);
                s.setA5(answer5);

                //Add the event object to the array
                doctorViewAnswers.add(s);
            }

            return 1;

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return 0;
    }
}