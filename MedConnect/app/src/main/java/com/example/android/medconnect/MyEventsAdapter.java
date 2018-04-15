package com.example.android.medconnect;

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

public class MyEventsAdapter extends BaseAdapter {

    //Current State of the application
    Context c;
    //Array list of Events
    ArrayList<MyEvents> myEvents;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public MyEventsAdapter(Context c, ArrayList<MyEvents> myEvents) {
        this.c = c;
        this.myEvents = myEvents;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return myEvents.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) {
        return myEvents.get(position);
    }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return myEvents.get(position).getId();
    }

    //Manipulate the data from the database
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_my_events, parent, false);
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
        eventIDTxt.setText(myEvents.get(position).getEventID());
        nameTxt.setText(myEvents.get(position).getName());
        locationTxt.setText(myEvents.get(position).getLocation());
        dateTxt.setText(myEvents.get(position).getDate());
        timeTxt.setText(myEvents.get(position).getTime());
        priceTxt.setText("Price: $" + myEvents.get(position).getPrice());
        descriptionTxt.setText(myEvents.get(position).getDescription());
        attendanceTxt.setText("Attendees: " + myEvents.get(position).getAttendance());

        //Handle item clicks
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //Store data locally in order to pass it to the Update window
                SharedPreferences preferences = c.getSharedPreferences("eventInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();

                editor.putString("eventID", myEvents.get(position).getEventID());
                editor.putString("name", myEvents.get(position).getName());
                editor.putString("location", myEvents.get(position).getLocation());
                editor.putString("date", myEvents.get(position).getDate());
                editor.putString("time", myEvents.get(position).getTime());
                editor.putString("price", myEvents.get(position).getPrice());
                editor.putString("description", myEvents.get(position).getDescription());
                editor.apply();

                //Open the update screen
                Intent i = new Intent(c, MyEventsUpdateActivity.class);
                c.startActivity(i);

            };

        });

        return convertView;
    }
}