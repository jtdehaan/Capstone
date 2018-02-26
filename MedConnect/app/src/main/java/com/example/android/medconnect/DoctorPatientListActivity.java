package com.example.android.medconnect;

import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import org.json.JSONArray;
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
        adapter=new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, data);
        lv.setAdapter(adapter);

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
        }catch (Exception e)
        {
            e.printStackTrace();
        }
    }
}
