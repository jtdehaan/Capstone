package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.example.android.medconnect.PatientList;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/15/2018.
 */

public class PatientListAdapter extends BaseAdapter {

    Context c;
    ArrayList<PatientList> patientLists;
    LayoutInflater inflater;
    String patient_id;

    public PatientListAdapter(Context c, ArrayList<PatientList> patientLists) {
        this.c = c;
        this.patientLists = patientLists;

        //INITIALIE
        inflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    //Determine size of the array
    @Override
    public int getCount() {
        return patientLists.size();
    }

    //Item contained within the array position
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
               // Toast.makeText(c, patientLists.get(position).getName(), Toast.LENGTH_SHORT).show();
               // Toast.makeText(c, patientLists.get(position).getUser_id(), Toast.LENGTH_SHORT).show();

                patient_id = patientLists.get(position).getUser_id();

                SharedPreferences preferences = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putString("patient_id", patient_id);
                editor.apply();

                SharedPreferences sharedPref = c.getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String doctor_id = sharedPref.getString("user_id", "");
                String patient_id = sharedPref.getString("patient_id", "");

                /*
                Toast.makeText(getApplicationContext(), patient_id,
                        Toast.LENGTH_LONG).show();\
                        */

                ///*

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                               /* AlertDialog.Builder builder = new AlertDialog.Builder(DoctorPatientListActivity.);
                                builder.setMessage("Success! You are now connected!")
                                        .setPositiveButton("Ok", null)
                                        .create()
                                        .show(); */
                                Toast.makeText(c, "Successfully connected with " + patientLists.get(position).getName(), Toast.LENGTH_SHORT).show();

                            } else {
                                // When clicked, show a toast with the TextView text
                                Toast.makeText(c, "Nooooooooo!",
                                        Toast.LENGTH_LONG).show();
                            }
                            //}
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                DoctorPatientListRequest doctorPatientListRequest = new DoctorPatientListRequest(doctor_id, patient_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(c);
                queue.add(doctorPatientListRequest);

                //*/

            }
        });

        return convertView;
    }
}