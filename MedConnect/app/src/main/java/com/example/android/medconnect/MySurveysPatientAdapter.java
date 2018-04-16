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

public class MySurveysPatientAdapter extends BaseAdapter {
    Context c;
    ArrayList<MySurveysDoctor> mySurveys;
    LayoutInflater inflater;

    public MySurveysPatientAdapter(Context c, ArrayList<MySurveysDoctor> mySurveys) {
        this.c = c;
        this.mySurveys = mySurveys;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return mySurveys.size();
    }

    //Item contained within the array position
    @Override
    public Object getItem(int position) {
        return mySurveys.get(position);
    }

    @Override
    public long getItemId(int position) {
        return mySurveys.get(position).getId();
    }


    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_my_surveys_doctor, parent, false);
        }

        //String name, location, date, time, price, description, attendance;

        TextView SurveyIDTxt = (TextView) convertView.findViewById(R.id.SurveyIDTxt);
        TextView nameTxt = (TextView) convertView.findViewById(R.id.nameTxt);
        TextView question1Txt = (TextView) convertView.findViewById(R.id.etQuestion1);
        TextView question2Txt = (TextView) convertView.findViewById(R.id.etQuestion2);
        TextView question3Txt = (TextView) convertView.findViewById(R.id.etQuestion3);
        TextView question4Txt = (TextView) convertView.findViewById(R.id.etQuestion4);
        TextView question5Txt = (TextView) convertView.findViewById(R.id.etQuestion5);


        SurveyIDTxt.setText(mySurveys.get(position).getSurveyID());
        nameTxt.setText(mySurveys.get(position).getName());
        question1Txt.setText(mySurveys.get(position).getQuestion1());
        question2Txt.setText(mySurveys.get(position).getQuestion2());
        question3Txt.setText(mySurveys.get(position).getQuestion3());
        question4Txt.setText(mySurveys.get(position).getQuestion4());
        question5Txt.setText(mySurveys.get(position).getQuestion5());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


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

                //add in after update ready
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
