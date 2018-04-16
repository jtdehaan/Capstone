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

    //Current State of the application
    Context c;
    //Array list of Events
    ArrayList<EventsList> eventsList;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public EventsListAdapter(Context c, ArrayList<EventsList> eventsList) {
        this.c = c;
        this.eventsList = eventsList;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return eventsList.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) {
        return eventsList.get(position);
    }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return eventsList.get(position).getId();
    }

    //Manipulate the data from the database
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_events, parent, false);
        }

        //Textviews containing the name, location, date, time, price, description, attendance
        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView locationTxt = (TextView) convertView.findViewById(R.id.locationTxt);
        TextView dateTxt = (TextView) convertView.findViewById(R.id.dateTxt);
        TextView timeTxt = (TextView) convertView.findViewById(R.id.timeTxt);
        TextView priceTxt = (TextView) convertView.findViewById(R.id.priceTxt);
        TextView descriptionTxt = (TextView) convertView.findViewById(R.id.descriptionTxt);
        TextView attendanceTxt = (TextView) convertView.findViewById(R.id.attendanceTxt);

        //Set text of the textviews with the appropriate values
        nameTxt.setText(eventsList.get(position).getName());
        locationTxt.setText(eventsList.get(position).getLocation());
        dateTxt.setText(eventsList.get(position).getDate());
        timeTxt.setText(eventsList.get(position).getTime());
        priceTxt.setText("Price: $" + eventsList.get(position).getPrice());
        descriptionTxt.setText(eventsList.get(position).getDescription());
        attendanceTxt.setText("Attendees: " + eventsList.get(position).getAttendance());

        return convertView;
    }
}