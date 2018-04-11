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

    Context c;
    ArrayList<MySurveysDoctor> mySurveysDoctor;
    LayoutInflater inflater;

    public MySurveyDoctorAdapter(Context c, ArrayList<MySurveysDoctor> mySurveysDoctor) {
        this.c = c;
        this.mySurveysDoctor = mySurveysDoctor;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return mySurveysDoctor.size();
    }

    //Item contained within the array position
    @Override
    public Object getItem(int position) {
        return mySurveysDoctor.get(position);
    }

    @Override
    public long getItemId(int position) {
        return mySurveysDoctor.get(position).getId();
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


        SurveyIDTxt.setText(mySurveysDoctor.get(position).getSurveyID());
        nameTxt.setText(mySurveysDoctor.get(position).getName());
        question1Txt.setText(mySurveysDoctor.get(position).getQuestion1());
        question2Txt.setText(mySurveysDoctor.get(position).getQuestion2());
        question3Txt.setText(mySurveysDoctor.get(position).getQuestion3());
        question4Txt.setText(mySurveysDoctor.get(position).getQuestion4());
        question5Txt.setText(mySurveysDoctor.get(position).getQuestion5());

        //ITEM CLICKS
        convertView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                SharedPreferences preferences = c.getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();

                editor.putString("surveyID", mySurveysDoctor.get(position).getSurveyID());
                editor.putString("name", mySurveysDoctor.get(position).getName());
                editor.putString("question1", mySurveysDoctor.get(position).getQuestion1());
                editor.putString("question2", mySurveysDoctor.get(position).getQuestion2());
                editor.putString("question3", mySurveysDoctor.get(position).getQuestion3());
                editor.putString("question4", mySurveysDoctor.get(position).getQuestion4());
                editor.putString("question5", mySurveysDoctor.get(position).getQuestion5());
                editor.apply();

                //add in after update ready
                Intent i = new Intent(c, MySurveysDoctorUpdate.class);
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