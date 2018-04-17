package com.example.android.medconnect;


import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
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

public class add_survey extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_survey);

        final EditText etSurveyName = (EditText) findViewById(R.id.etSurveyName);
        final EditText etq1 = (EditText) findViewById(R.id.etQuestion1);
        final EditText etq2 = (EditText) findViewById(R.id.etQuestion2);
        final EditText etq3 = (EditText) findViewById(R.id.etQuestion3);
        final EditText etq4 = (EditText) findViewById(R.id.etQuestion4);
        final EditText etq5 = (EditText) findViewById(R.id.etQuestion5);
        final Button bRegister = (Button) findViewById(R.id.bCreateSurvey);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerAddIntent = new Intent(add_survey.this, DoctorActivity.class);
                add_survey.this.startActivity(registerAddIntent);
            }
        });

        bRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String SurveyName = etSurveyName.getText().toString();
                final String Question1 = etq1.getText().toString();
                final String Question2 = etq2.getText().toString();
                final String Question3 = etq3.getText().toString();
                final String Question4 = etq4.getText().toString();
                final String Question5 = etq5.getText().toString();

                if(SurveyName.isEmpty()){
                    Toast.makeText(add_survey.this, "Please enter a Name", Toast.LENGTH_SHORT).show();
                }else {

                    SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                    final String ID = preferences.getString("user_id", "1");

                    Response.Listener<String> responseListener = new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject jsonResponse = new JSONObject(response);
                                boolean success = jsonResponse.getBoolean("success");
                                if (success) {
                                    Intent registerAddIntent = new Intent(add_survey.this, DoctorActivity.class);
                                    add_survey.this.startActivity(registerAddIntent);
                                    Toast.makeText(add_survey.this, "Succesfully created a survey", Toast.LENGTH_SHORT).show();
                                } else {
                                    AlertDialog.Builder builder = new AlertDialog.Builder(add_survey.this);
                                    builder.setMessage("Registration Failed")
                                            .setNegativeButton("Retry", null)
                                            .create()
                                            .show();
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    };

                    AddSurveyRequest addSurveyRequest = new AddSurveyRequest(SurveyName, Question1, Question2, Question3, Question4, Question5, ID, responseListener);
                    RequestQueue queue = Volley.newRequestQueue(add_survey.this);
                    queue.add(addSurveyRequest);
                }
            }
        });
    }
}