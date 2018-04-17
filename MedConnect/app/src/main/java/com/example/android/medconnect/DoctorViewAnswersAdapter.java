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
import com.example.android.medconnect.DoctorViewAnswers;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.ArrayList;

/**
 * Created by Alex 4/16/2018.
 */

public class DoctorViewAnswersAdapter extends BaseAdapter {

    //Current State of the application
    Context c;
    //Array list of Events
    ArrayList<DoctorViewAnswers> doctorViewAnswers;
    //Build view objects from the xml file
    LayoutInflater inflater;

    //Constructor
    public DoctorViewAnswersAdapter(Context c, ArrayList<DoctorViewAnswers> doctorViewAnswers) {
        this.c = c;
        this.doctorViewAnswers = doctorViewAnswers;

        //Initialize the inflator to instantiate view objects into corresponding xml file
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }



    //Determine size of the array
    @Override
    public int getCount() {
        return doctorViewAnswers.size();
    }

    //Access the list's data
    @Override
    public Object getItem(int position) {
        return doctorViewAnswers.get(position);
    }

    //ID of the row in the list
    @Override
    public long getItemId(int position) {
        return doctorViewAnswers.get(position).getId();
    }

    //Manipulate the data from the database
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.model_view_answers, parent, false);
        }

        //Textviews containing the Survey ID, the questions, and the answers
        TextView surveyID = (TextView) convertView.findViewById(R.id.surveyIDTxt);
        TextView answer1 = (TextView) convertView.findViewById(R.id.answer1Txt);
        TextView answer2 = (TextView) convertView.findViewById(R.id.answer2Txt);
        TextView answer3 = (TextView) convertView.findViewById(R.id.answer3Txt);
        TextView answer4 = (TextView) convertView.findViewById(R.id.answer4Txt);
        TextView answer5 = (TextView) convertView.findViewById(R.id.answer5Txt);
        TextView question1 = (TextView) convertView.findViewById(R.id.question1Txt);
        TextView question2 = (TextView) convertView.findViewById(R.id.question2Txt);
        TextView question3 = (TextView) convertView.findViewById(R.id.question3Txt);
        TextView question4 = (TextView) convertView.findViewById(R.id.question4Txt);
        TextView question5 = (TextView) convertView.findViewById(R.id.question5Txt);

        //Get questions from the survey to display above the answers
        SharedPreferences sharedPref = c.getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
        final String shQuestion1 = sharedPref.getString("question1", "");
        final String shQuestion2 = sharedPref.getString("question2", "");
        final String shQuestion3 = sharedPref.getString("question3", "");
        final String shQuestion4 = sharedPref.getString("question4", "");
        final String shQuestion5 = sharedPref.getString("question5", "");

        //Set text of the textviews with the appropriate values
        surveyID.setText(doctorViewAnswers.get(position).getSurveyID());
        answer1.setText(doctorViewAnswers.get(position).getA1());
        answer2.setText(doctorViewAnswers.get(position).getA2());
        answer3.setText(doctorViewAnswers.get(position).getA3());
        answer4.setText(doctorViewAnswers.get(position).getA4());
        answer5.setText(doctorViewAnswers.get(position).getA5());
        question1.setText(shQuestion1);
        question2.setText(shQuestion2);
        question3.setText(shQuestion3);
        question4.setText(shQuestion4);
        question5.setText(shQuestion5);

        return convertView;
    }
}