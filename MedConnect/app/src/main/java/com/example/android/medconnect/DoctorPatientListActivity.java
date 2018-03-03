package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class DoctorPatientListActivity extends AppCompatActivity {

    ListView lv;
    ArrayAdapter<String> adapter;
    String address="http://cgi.soic.indiana.edu/~team37/Patient_List.php";
    InputStream inputStream=null;
    String line = null;
    String result = null;
    String[] data;
    String[] data2;
    //String[][] totalData

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_patient_list);

        lv=(ListView) findViewById(R.id.lvpatientList);

        //ALLOW NETWORK IN MAIN THREAD
        StrictMode.setThreadPolicy((new StrictMode.ThreadPolicy.Builder().permitNetwork().build()));

        //RETRIEVE
        getData();

        //ADAPTER
        adapter=new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, data2);
        lv.setAdapter(adapter);

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView <? > arg0, View view, int position, long id) {

                // patient_id = ((TextView) view).getText().toString();

                //Toast.makeText(getApplicationContext(), patient_id,
                  //      Toast.LENGTH_LONG).show();


                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putString("patient_id", ((TextView) view).getText().toString());
                editor.apply();

                SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String doctor_id = sharedPref.getString("user_id", "");
                String patient_id = sharedPref.getString("patient_id", "");

                Toast.makeText(getApplicationContext(), patient_id,
                      Toast.LENGTH_LONG).show();

                ///*

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                                AlertDialog.Builder builder = new AlertDialog.Builder(DoctorPatientListActivity.this);
                                builder.setMessage("Success! You are now connected!")
                                        .setPositiveButton("Ok", null)
                                        .create()
                                        .show();

                            } else {
                                // When clicked, show a toast with the TextView text
                                Toast.makeText(getApplicationContext(), "Nooooooooo!",
                                        Toast.LENGTH_LONG).show();
                            }
                            //}
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                DoctorPatientListRequest doctorPatientListRequest = new DoctorPatientListRequest(doctor_id, patient_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(DoctorPatientListActivity.this);
                queue.add(doctorPatientListRequest);

                //*/

            }
        });
    }

    private void getData()
    {
        try
        {
            URL url = new URL(address);
            HttpURLConnection con = (HttpURLConnection) url.openConnection();

            con.setRequestMethod("GET");

            inputStream = new BufferedInputStream(con.getInputStream());
        }catch (Exception e)
        {
            e.printStackTrace();
        }

        //READ CONTENT INTO A STRING

        try
        {
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
            StringBuilder stringBuilder = new StringBuilder();

            while((line= bufferedReader.readLine()) != null)
            {
                stringBuilder.append(line+"\n");
            }
            inputStream.close();
            result=stringBuilder.toString();

        } catch (Exception e)
        {
            e.printStackTrace();
        }

        //PARSE JSON DATA
        try {
            JSONArray jsonArray = new JSONArray(result);
            JSONObject jsonObject = null;

            data = new String[jsonArray.length()];

            for (int i = 0; i < jsonArray.length(); i++) {
                jsonObject = jsonArray.getJSONObject(i);
                data[i] = jsonObject.getString("name");
            }

            data2 = new String[jsonArray.length()];

            for (int i = 0; i < jsonArray.length(); i++) {
                jsonObject = jsonArray.getJSONObject(i);
                data2[i] = jsonObject.getString("user_id");
            }

        }catch (Exception e)
        {
            e.printStackTrace();
        }
    }
}
