package com.example.android.medconnect;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import com.example.android.medconnect.PatientRegisteredEvents;
import com.example.android.medconnect.PatientRegisteredEventsAdapter;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by Alex on 4/14/2018
 */

public class PatientRegisteredEventsParser extends AsyncTask<Void, Void, Integer> {

    //Context to be passed to the progress dialog
    Context c;
    //Listview holding the data
    ListView lv;
    //Data read from PHP script
    String jsonData;

    //Show progress of parsing process
    ProgressDialog pd;
    //Array list of Events
    ArrayList<PatientRegisteredEvents> patientRegisteredEvents = new ArrayList<>();

    //Constructor
    public PatientRegisteredEventsParser(Context c, ListView lv, String jsonData) {
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
            PatientRegisteredEventsAdapter adapter = new PatientRegisteredEventsAdapter(c, patientRegisteredEvents);
            lv.setAdapter(adapter);
        }
    }

    private int parseData() {
        try {
            //Initialize a JSON array and object to pull data from PHP script
            JSONArray ja = new JSONArray(jsonData);
            JSONObject jo = null;

            //Reset the list in order to add new values
            patientRegisteredEvents.clear();
            PatientRegisteredEvents s = null;

            //Loop through the array
            for (int i = 0; i < ja.length(); i++) {

                //Set the object equal to the current position in the array
                jo = ja.getJSONObject(i);

                //Retrieve values from corresponding columns in database
                int id = jo.getInt("EventID");
                String name = jo.getString("name");
                String location = jo.getString("location");
                String date = jo.getString("date");
                String time = jo.getString("time");
                String price = jo.getString("price");
                String description = jo.getString("description");
                String attendance = jo.getString("attendance");
                String eventID = jo.getString("EventID");

                //Set values in the event object
                s = new PatientRegisteredEvents();
                s.setId(id);
                s.setName(name);
                s.setLocation(location);
                s.setDate(date);
                s.setTime(time);
                s.setPrice(price);
                s.setDescription(description);
                s.setAttendance(attendance);
                s.setEventID(eventID);

                //Add the event object to the array
                patientRegisteredEvents.add(s);
            }

            return 1;


        } catch (JSONException e) {
            e.printStackTrace();
        }

        return 0;
    }
}