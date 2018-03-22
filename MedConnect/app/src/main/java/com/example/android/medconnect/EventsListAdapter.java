package com.example.android.medconnect;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.example.android.medconnect.EventsList;

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

        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView user_idTxt = (TextView) convertView.findViewById(R.id.user_idTxt);

        nameTxt.setText(eventsList.get(position).getName());
        user_idTxt.setText(eventsList.get(position).getUser_id());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(c, eventsList.get(position).getName(), Toast.LENGTH_SHORT).show();
            }
        });

        return convertView;
    }
}