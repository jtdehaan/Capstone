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

    Context c;
    ArrayList<PatientEvents> patientEvents;
    LayoutInflater inflater;

    public PatientEventsAdapter(Context c, ArrayList<PatientEvents> patientEvents) {
        this.c = c;
        this.patientEvents = patientEvents;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return patientEvents.size();
    }

    //Item contained within the array position
    @Override
    public Object getItem(int position) { return patientEvents.get(position); }

    @Override
    public long getItemId(int position) {
        return patientEvents.get(position).getId();
    }


    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_patient_events, parent, false);
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

        eventIDTxt.setText(patientEvents.get(position).getEventID());
        nameTxt.setText(patientEvents.get(position).getName());
        locationTxt.setText(patientEvents.get(position).getLocation());
        dateTxt.setText(patientEvents.get(position).getDate());
        timeTxt.setText(patientEvents.get(position).getTime());
        priceTxt.setText(patientEvents.get(position).getPrice());
        descriptionTxt.setText(patientEvents.get(position).getDescription());
        attendanceTxt.setText(patientEvents.get(position).getAttendance());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               //Toast.makeText(c, patientEvents.get(position).getLocation(), Toast.LENGTH_SHORT).show();
                // Toast.makeText(c, patientLists.get(position).getUser_id(), Toast.LENGTH_SHORT).show();

                String event_id = patientEvents.get(position).getEventID();

                SharedPreferences sharedPref = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String patient_id = sharedPref.getString("user_id", "");


                /*
                Toast.makeText(getApplicationContext(), patient_id,
                        Toast.LENGTH_LONG).show();\
                        */


                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                                /*AlertDialog.Builder builder = new AlertDialog.Builder(DoctorPatientListActivity.);
                                builder.setMessage("Success! You are now connected!")
                                        .setPositiveButton("Ok", null)
                                        .create()
                                        .show();*/
                                Toast.makeText(c, "Successfully registered for the '" + patientEvents.get(position).getName() + "' event!", Toast.LENGTH_SHORT).show();

                            } else {
                                // When clicked, show a toast with the TextView text
                                Toast.makeText(c, "Nooooooooo!",
                                        Toast.LENGTH_LONG).show();
                            }
                            //}
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