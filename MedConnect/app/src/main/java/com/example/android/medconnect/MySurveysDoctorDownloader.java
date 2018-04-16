package com.example.android.medconnect;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;

/**
 * Created by Jacob on 4/6/2018.
 */


public class MySurveysDoctorDownloader extends AsyncTask<Void, Void, String> {

    //Context to be passed to the progress dialog
    Context c;
    //URL containing data from the database
    String urlAddress;
    //Listview holding the data
    ListView lv;

    //Show progress of downloading process
    ProgressDialog pd;

    //Constructor
    public MySurveysDoctorDownloader(Context c, String urlAddress, ListView lv) {
        this.c = c;
        this.urlAddress = urlAddress;
        this.lv = lv;
    }

    //Initialize progress dialog and display it
    @Override
    protected void onPreExecute() {
        super.onPreExecute();

        pd = new ProgressDialog(c);
        pd.setTitle("Download");
        pd.setMessage("Downloading...");
        pd.show();
    }

    @Override
    protected String doInBackground(Void... params) {
        //Perform background computation of data downloading process
        return this.downloadData();
    }


    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);

        //Stop the progress dialog
        pd.dismiss();

        //Notify the user if download is unsuccessful, otherwise parse the data
        if (s == null) {
            Toast.makeText(c, "Unsuccessfull download, null returned", Toast.LENGTH_SHORT).show();
        } else {
            //Call the data parser to parse the data
            MySurveysDoctorParser parser = new MySurveysDoctorParser(c, lv, s);
            parser.execute();

        }


    }


    private String downloadData() {
        //Establish connection to download data from database
        HttpURLConnection con = MySurveysDoctorConnector.connect(urlAddress);
        if (con == null) {
            return null;
        }

        //Initialize input stream to null
        InputStream inputStream = null;
        try {

            //Read data from source
            inputStream = new BufferedInputStream(con.getInputStream());
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));

            String line = null;
            //Store data in a modifiable string sequence
            StringBuffer response = new StringBuffer();

            //If the response is not a null value, append it to the StringBuffer and add a new line
            if (bufferedReader != null) {
                while ((line = bufferedReader.readLine()) != null) {
                    response.append(line + "\n");
                }

                //Terminate the character-input stream reader
                bufferedReader.close();

            } else {
                return null;
            }

            //Return string sequence
            return response.toString();

        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            //Close the byte input stream if it is not a null value (move onto the next stream)
            if (inputStream != null) {
                try {
                    inputStream.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }

        return null;
    }
}