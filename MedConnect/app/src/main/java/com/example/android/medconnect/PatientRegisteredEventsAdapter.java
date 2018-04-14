package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
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
import com.example.android.medconnect.MyEvents;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/21/2018.
 */

public class PatientRegisteredEventsAdapter extends BaseAdapter {

    Context c;
    ArrayList<PatientRegisteredEvents> patientRegisteredEvents;
    LayoutInflater inflater;

    public PatientRegisteredEventsAdapter(Context c, ArrayList<PatientRegisteredEvents> patientRegisteredEvents) {
        this.c = c;
        this.patientRegisteredEvents = patientRegisteredEvents;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return patientRegisteredEvents.size();
    }

    //Item contained within the array position
    @Override
    public Object getItem(int position) {
        return patientRegisteredEvents.get(position);
    }

    @Override
    public long getItemId(int position) {
        return patientRegisteredEvents.get(position).getId();
    }


    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_patient_registered_events, parent, false);
        }

        //String name, location, date, time, price, description, attendance;

        TextView eventIDTxt = (TextView) convertView.findViewById(R.id.eventIDTxt);
        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView locationTxt = (TextView) convertView.findViewById(R.id.locationTxt);
        TextView dateTxt = (TextView) convertView.findViewById(R.id.dateTxt);
        TextView timeTxt = (TextView) convertView.findViewById(R.id.timeTxt);
        TextView priceTxt = (TextView) convertView.findViewById(R.id.priceTxt);
        TextView descriptionTxt = (TextView) convertView.findViewById(R.id.descriptionTxt);
        TextView attendanceTxt = (TextView) convertView.findViewById(R.id.attendanceTxt);

        eventIDTxt.setText(patientRegisteredEvents.get(position).getEventID());
        nameTxt.setText(patientRegisteredEvents.get(position).getName());
        locationTxt.setText(patientRegisteredEvents.get(position).getLocation());
        dateTxt.setText(patientRegisteredEvents.get(position).getDate());
        timeTxt.setText(patientRegisteredEvents.get(position).getTime());
        priceTxt.setText(patientRegisteredEvents.get(position).getPrice());
        descriptionTxt.setText(patientRegisteredEvents.get(position).getDescription());
        attendanceTxt.setText(patientRegisteredEvents.get(position).getAttendance());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //Toast.makeText(c, "Testing" , Toast.LENGTH_SHORT).show();

                String event_id = patientRegisteredEvents.get(position).getEventID();

                SharedPreferences sharedPref = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String patient_id = sharedPref.getString("user_id", "");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {

                                Toast.makeText(c, "You have unregistered from the '" + patientRegisteredEvents.get(position).getName() + "' event!" , Toast.LENGTH_SHORT).show();

                            } else {

                                Toast.makeText(c, "Error" , Toast.LENGTH_SHORT).show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                PatientRegisteredEventsRequest patientRegisteredEventsRequest = new PatientRegisteredEventsRequest(event_id, patient_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(c);
                queue.add(patientRegisteredEventsRequest);
            }

        });

        return convertView;
    }
}