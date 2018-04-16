package com.example.android.medconnect;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Jacob on 4/16/2018.
 */


public class MySurveysPatientAdapter extends BaseAdapter {

    //Current State of the application
    Context c;
    //Array list of Events
    ArrayList<MySurveysDoctor> mySurveys;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public MySurveysPatientAdapter(Context c, ArrayList<MySurveysDoctor> mySurveys) {
        this.c = c;
        this.mySurveys = mySurveys;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return mySurveys.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) {
        return mySurveys.get(position);
    }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return mySurveys.get(position).getId();
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
        SurveyIDTxt.setText(mySurveys.get(position).getSurveyID());
        nameTxt.setText(mySurveys.get(position).getName());
        question1Txt.setText(mySurveys.get(position).getQuestion1());
        question2Txt.setText(mySurveys.get(position).getQuestion2());
        question3Txt.setText(mySurveys.get(position).getQuestion3());
        question4Txt.setText(mySurveys.get(position).getQuestion4());
        question5Txt.setText(mySurveys.get(position).getQuestion5());

        //Handle item clicks
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                //Store data locally in order to pass it to the survey window
                SharedPreferences preferences = c.getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();

                editor.putString("SurveyID", mySurveys.get(position).getSurveyID());
                editor.putString("name", mySurveys.get(position).getName());
                editor.putString("question1", mySurveys.get(position).getQuestion1());
                editor.putString("question2", mySurveys.get(position).getQuestion2());
                editor.putString("question3", mySurveys.get(position).getQuestion3());
                editor.putString("question4", mySurveys.get(position).getQuestion4());
                editor.putString("question5", mySurveys.get(position).getQuestion5());
                editor.apply();

                //Open the survey screen
                Intent i = new Intent(c, TakeSurvey.class);
                c.startActivity(i);


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
