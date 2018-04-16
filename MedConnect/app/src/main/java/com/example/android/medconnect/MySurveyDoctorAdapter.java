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

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/21/2018.
 */

public class MySurveyDoctorAdapter extends BaseAdapter {

    //Current State of the application
    Context c;
    //Array list of Surveys
    ArrayList<MySurveysDoctor> mySurveysDoctor;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public MySurveyDoctorAdapter(Context c, ArrayList<MySurveysDoctor> mySurveysDoctor) {
        this.c = c;
        this.mySurveysDoctor = mySurveysDoctor;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return mySurveysDoctor.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) {
        return mySurveysDoctor.get(position);
    }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return mySurveysDoctor.get(position).getId();
    }

    //Manipulate the data from the database
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_my_surveys_doctor, parent, false);
        }

        //Textviews containing the name, location, date, time, price, description, attendance
        TextView SurveyIDTxt = (TextView) convertView.findViewById(R.id.SurveyIDTxt);
        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView question1Txt = (TextView) convertView.findViewById(R.id.etQuestion1);
        TextView question2Txt = (TextView) convertView.findViewById(R.id.etQuestion2);
        TextView question3Txt = (TextView) convertView.findViewById(R.id.etQuestion3);
        TextView question4Txt = (TextView) convertView.findViewById(R.id.etQuestion4);
        TextView question5Txt = (TextView) convertView.findViewById(R.id.etQuestion5);

        //Set text of the textviews with the appropriate values
        SurveyIDTxt.setText(mySurveysDoctor.get(position).getSurveyID());
        nameTxt.setText(mySurveysDoctor.get(position).getName());
        question1Txt.setText(mySurveysDoctor.get(position).getQuestion1());
        question2Txt.setText(mySurveysDoctor.get(position).getQuestion2());
        question3Txt.setText(mySurveysDoctor.get(position).getQuestion3());
        question4Txt.setText(mySurveysDoctor.get(position).getQuestion4());
        question5Txt.setText(mySurveysDoctor.get(position).getQuestion5());

        //Handle item clicks
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //Store data locally in order to pass it to the Update window
                SharedPreferences preferences = c.getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();

                editor.putString("SurveyID", mySurveysDoctor.get(position).getSurveyID());
                editor.putString("name", mySurveysDoctor.get(position).getName());
                editor.putString("question1", mySurveysDoctor.get(position).getQuestion1());
                editor.putString("question2", mySurveysDoctor.get(position).getQuestion2());
                editor.putString("question3", mySurveysDoctor.get(position).getQuestion3());
                editor.putString("question4", mySurveysDoctor.get(position).getQuestion4());
                editor.putString("question5", mySurveysDoctor.get(position).getQuestion5());
                editor.apply();

                //Open the update screen
                Intent i = new Intent(c, MySurveysDoctorUpdate.class);
                c.startActivity(i);


            };

        });

        return convertView;
    }
}