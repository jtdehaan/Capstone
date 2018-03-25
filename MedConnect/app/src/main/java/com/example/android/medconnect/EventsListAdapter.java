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

public class EventsListAdapter extends BaseAdapter {

    Context c;
    ArrayList<EventsList> eventsList;
    LayoutInflater inflater;

    public EventsListAdapter(Context c, ArrayList<EventsList> eventsList) {
        this.c = c;
        this.eventsList = eventsList;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return eventsList.size();
    }

    @Override
    public Object getItem(int position) {
        return eventsList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return eventsList.get(position).getId();
    }


    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_events, parent, false);
        }

        //String name, location, date, time, price, description, attendance;

        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView locationTxt = (TextView) convertView.findViewById(R.id.locationTxt);
        TextView dateTxt = (TextView) convertView.findViewById(R.id.dateTxt);
        TextView timeTxt = (TextView) convertView.findViewById(R.id.timeTxt);
        TextView priceTxt = (TextView) convertView.findViewById(R.id.priceTxt);
        TextView descriptionTxt = (TextView) convertView.findViewById(R.id.descriptionTxt);
        TextView attendanceTxt = (TextView) convertView.findViewById(R.id.attendanceTxt);

        nameTxt.setText(eventsList.get(position).getName());
        locationTxt.setText(eventsList.get(position).getLocation());
        dateTxt.setText(eventsList.get(position).getDate());
        timeTxt.setText(eventsList.get(position).getTime());
        priceTxt.setText(eventsList.get(position).getPrice());
        descriptionTxt.setText(eventsList.get(position).getDescription());
        attendanceTxt.setText(eventsList.get(position).getAttendance());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(c, eventsList.get(position).getLocation(), Toast.LENGTH_SHORT).show();
                // Toast.makeText(c, patientLists.get(position).getUser_id(), Toast.LENGTH_SHORT).show();

                /*
                patient_id = eventsList.get(position).getUser_id();

                SharedPreferences preferences = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putString("patient_id", patient_id);
                editor.apply();

                SharedPreferences sharedPref = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String doctor_id = sharedPref.getString("user_id", "");
                String patient_id = sharedPref.getString("patient_id", "");

                */

                /*
                Toast.makeText(getApplicationContext(), patient_id,
                        Toast.LENGTH_LONG).show();\
                        */

                ///*

                /*
                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                               /* AlertDialog.Builder builder = new AlertDialog.Builder(DoctorPatientListActivity.);
                                builder.setMessage("Success! You are now connected!")
                                        .setPositiveButton("Ok", null)
                                        .create()
                                        .show();
                                Toast.makeText(c, "Successfully connected with " + patientLists.get(position).getName(), Toast.LENGTH_SHORT).show();

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
                    */
                };

            /*
                DoctorPatientListRequest doctorPatientListRequest = new DoctorPatientListRequest(doctor_id, patient_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(c);
                queue.add(doctorPatientListRequest);

                //*/

        });

        return convertView;
    }
}