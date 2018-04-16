package com.example.android.medconnect;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class TakeSurvey extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_take_survey);

        final EditText etq1a = (EditText) findViewById(R.id.etQuestion1a);
        final EditText etq2a = (EditText) findViewById(R.id.etQuestion2a);
        final EditText etq3a = (EditText) findViewById(R.id.etQuestion3a);
        final EditText etq4a = (EditText) findViewById(R.id.etQuestion4a);
        final EditText etq5a = (EditText) findViewById(R.id.etQuestion5a);
        final TextView etq1 = (TextView) findViewById(R.id.etQuestion1);
        final TextView etq2 = (TextView) findViewById(R.id.etQuestion2);
        final TextView etq3 = (TextView) findViewById(R.id.etQuestion3);
        final TextView etq4 = (TextView) findViewById(R.id.etQuestion4);
        final TextView etq5 = (TextView) findViewById(R.id.etQuestion5);
        final Button bUpdate = (Button) findViewById(R.id.bSubmitSurvey);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);


        SharedPreferences sharedPref = getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
        final String SurveyID = sharedPref.getString("SurveyID", "");
        final String shq1 = sharedPref.getString("question1", "");
        final String shq2 = sharedPref.getString("question2", "");
        final String shq3 = sharedPref.getString("question3", "");
        final String shq4 = sharedPref.getString("question4", "");
        final String shq5 = sharedPref.getString("question5", "");

        SharedPreferences sharedPre = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String PatientID = sharedPre.getString("user_id", "");


        etq1.setText(shq1);
        etq2.setText(shq2);
        etq3.setText(shq3);
        etq4.setText(shq4);
        etq5.setText(shq5);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent cancelEditIntent = new Intent(TakeSurvey.this, Patient_Surveys.class);
                TakeSurvey.this.startActivity(cancelEditIntent);
            }
        });

        bUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                final String q1 = etq1a.getText().toString();
                final String q2 = etq2a.getText().toString();
                final String q3 = etq3a.getText().toString();
                final String q4 = etq4a.getText().toString();
                final String q5 = etq5a.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent cancelEditIntent = new Intent(TakeSurvey.this, Patient_Surveys.class);
                                TakeSurvey.this.startActivity(cancelEditIntent);

                                //String user_id = jsonResponse.getString("user_id");

                                SharedPreferences preferences = getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
                                //String user_id = preferences.getString("user_id", "");
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("question1a", q1);
                                editor.putString("question2a", q2);
                                editor.putString("question3a", q3);
                                editor.putString("question4a", q4);
                                editor.putString("question5a", q5);
                                editor.apply();

                                Toast.makeText(TakeSurvey.this, "Successfully Took Survey", Toast.LENGTH_SHORT).show();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(TakeSurvey.this);
                                builder.setMessage("Update Failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }
                            //}
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                TakeSurveyRequest takeSurveyRequest = new TakeSurveyRequest(SurveyID, q1, q2, q3, q4, q5, PatientID, responseListener);
                RequestQueue queue = Volley.newRequestQueue(TakeSurvey.this);
                queue.add(takeSurveyRequest);
            }
        });

    }
}
