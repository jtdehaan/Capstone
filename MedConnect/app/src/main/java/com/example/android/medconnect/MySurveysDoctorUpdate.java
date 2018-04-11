package com.example.android.medconnect;

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

public class MySurveysDoctorUpdate extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_surveys_doctor_update);

        final EditText etSurveyName = (EditText) findViewById(R.id.etName);
        final EditText etq1 = (EditText) findViewById(R.id.etQuestion1);
        final EditText etq2 = (EditText) findViewById(R.id.etQuestion2);
        final EditText etq3 = (EditText) findViewById(R.id.etQuestion3);
        final EditText etq4 = (EditText) findViewById(R.id.etQuestion4);
        final EditText etq5 = (EditText) findViewById(R.id.etQuestion5);
        final Button bUpdate = (Button) findViewById(R.id.bUpdateSurvey);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        SharedPreferences sharedPref = getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
        final String SurveyID = sharedPref.getString("SurveyID", "");
        final String shName = sharedPref.getString("name", "");
        final String shq1 = sharedPref.getString("question1", "");
        final String shq2 = sharedPref.getString("question2", "");
        final String shq3 = sharedPref.getString("question3", "");
        final String shq4 = sharedPref.getString("question4", "");
        final String shq5 = sharedPref.getString("question5", "");

        etSurveyName.setText(shName);
        etq1.setText(shq1);
        etq2.setText(shq2);
        etq3.setText(shq3);
        etq4.setText(shq4);
        etq5.setText(shq5);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent cancelEditIntent = new Intent(MySurveysDoctorUpdate.this, MySurveysDoctorActivity.class);
                MySurveysDoctorUpdate.this.startActivity(cancelEditIntent);
            }
        });

        bUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String name = etSurveyName.getText().toString();
                final String q1 = etq1.getText().toString();
                final String q2 = etq2.getText().toString();
                final String q3 = etq3.getText().toString();
                final String q4 = etq4.getText().toString();
                final String q5 = etq5.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent cancelEditIntent = new Intent(MySurveysDoctorUpdate.this, MySurveysDoctorActivity.class);
                                MySurveysDoctorUpdate.this.startActivity(cancelEditIntent);

                                //String user_id = jsonResponse.getString("user_id");

                                SharedPreferences preferences = getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
                                //String user_id = preferences.getString("user_id", "");
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("name", name);
                                editor.putString("q1", q1);
                                editor.putString("q2", q2);
                                editor.putString("q3", q3);
                                editor.putString("q4", q4);
                                editor.putString("q5", q5);
                                editor.apply();

                                Toast.makeText(MySurveysDoctorUpdate.this, "Successfully Updated Event", Toast.LENGTH_SHORT).show();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(MySurveysDoctorUpdate.this);
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

                MySurveyUpdateRequest mySurveyUpdateRequest = new MySurveyUpdateRequest(SurveyID, name, q1, q2, q3, q4, q5, responseListener);
                RequestQueue queue = Volley.newRequestQueue(MySurveysDoctorUpdate.this);
                queue.add(mySurveyUpdateRequest);
            }
        });

    }
}






