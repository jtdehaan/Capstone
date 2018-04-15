package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.example.android.medconnect.EventsList;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/21/2018.
 */

public class PatientEventsAdapter extends BaseAdapter {

    //Current State of the application
    Context c;
    //Array list of Events
    ArrayList<PatientEvents> patientEvents;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public PatientEventsAdapter(Context c, ArrayList<PatientEvents> patientEvents) {
        this.c = c;
        this.patientEvents = patientEvents;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return patientEvents.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) { return patientEvents.get(position); }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return patientEvents.get(position).getId();
    }

    //Manipulate the data from the database
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_patient_events, parent, false);
        }

        //Textviews containing the name, location, date, time, price, description, attendance
        TextView eventIDTxt = (TextView) convertView.findViewById(R.id.eventIDTxt);
        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView locationTxt = (TextView) convertView.findViewById(R.id.locationTxt);
        TextView dateTxt = (TextView) convertView.findViewById(R.id.dateTxt);
        TextView timeTxt = (TextView) convertView.findViewById(R.id.timeTxt);
        TextView priceTxt = (TextView) convertView.findViewById(R.id.priceTxt);
        TextView descriptionTxt = (TextView) convertView.findViewById(R.id.descriptionTxt);
        TextView attendanceTxt = (TextView) convertView.findViewById(R.id.attendanceTxt);

        //Set text of the textviews with the appropriate values
        eventIDTxt.setText(patientEvents.get(position).getEventID());
        nameTxt.setText(patientEvents.get(position).getName());
        locationTxt.setText(patientEvents.get(position).getLocation());
        dateTxt.setText(patientEvents.get(position).getDate());
        timeTxt.setText(patientEvents.get(position).getTime());
        priceTxt.setText("Price: $" + patientEvents.get(position).getPrice());
        descriptionTxt.setText(patientEvents.get(position).getDescription());
        attendanceTxt.setText("Attendees: " + patientEvents.get(position).getAttendance());

        //Handle item clicks
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String event_id = patientEvents.get(position).getEventID();

                SharedPreferences sharedPref = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String patient_id = sharedPref.getString("user_id", "");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                                Toast.makeText(c, "Successfully registered for the '" + patientEvents.get(position).getName() + "' event!", Toast.LENGTH_SHORT).show();

                            } else {
                                // When clicked when already registered, display a toast that tells the user they are already registered
                                Toast.makeText(c, "You have already registered for the '" + patientEvents.get(position).getName() + "' event!",
                                        Toast.LENGTH_LONG).show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                };

                PatientEventsRegisterRequest registerEventRequest = new PatientEventsRegisterRequest(event_id, patient_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(c);
                queue.add(registerEventRequest);

            }
        });
        return convertView;

    }
}