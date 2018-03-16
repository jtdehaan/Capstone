package com.example.android.medconnect;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.example.android.medconnect.PatientList;

import java.util.ArrayList;

/**
 * Created by aator on 3/15/2018.
 */

public class PatientListAdapter extends BaseAdapter {

    Context c;
    ArrayList<PatientList> patientLists;
    LayoutInflater inflater;

    public PatientListAdapter(Context c, ArrayList<PatientList> patientLists) {
        this.c = c;
        this.patientLists = patientLists;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return patientLists.size();
    }

    @Override
    public Object getItem(int position) {
        return patientLists.get(position);
    }

    @Override
    public long getItemId(int position) {
        return patientLists.get(position).getId();
    }


    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model, parent, false);
        }

        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView user_idTxt = (TextView) convertView.findViewById(R.id.user_idTxt);

        nameTxt.setText(patientLists.get(position).getName());
        user_idTxt.setText(patientLists.get(position).getUser_id());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(c, patientLists.get(position).getName(), Toast.LENGTH_SHORT).show();
            }
        });

        return convertView;
    }
}