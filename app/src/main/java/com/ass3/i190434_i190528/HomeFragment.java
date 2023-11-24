package com.ass3.i190434_i190528;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Bundle;
import android.text.SpannableStringBuilder;
import android.text.style.ForegroundColorSpan;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

public class HomeFragment extends Fragment {
    //FirebaseDatabase database = FirebaseDatabase.getInstance();
    //DatabaseReference reference = FirebaseDatabase.getInstance().getReference("users");
    //String nameFromDB;
    String name, city, country, email, phone, coverPhotoUrl, profilePhotoUrl;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        retrieveUserData(); // name, city, country, email, phone, coverPhotoUrl, profilePhotoUrl
        Bundle args = getArguments();
        if (args != null) {
            String nameUser = args.getString("nameUser");
            Log.d("HomeFragment", "nameFromDB; HF:" + nameUser);

//            FirebaseAuth mAuth = FirebaseAuth.getInstance();
//            UserDatabaseHelper userDatabaseHelper = new UserDatabaseHelper();
//            String userEmail = mAuth.getCurrentUser().getEmail().toString();
//            userDatabaseHelper.getUserData(userEmail, new UserDatabaseHelper.UserDataCallback() {
//                @Override
//                public void onUserDataReceived(HelperClass userData) {
//                    nameFromDB= userData.getName();
//                }
//                @Override
//                public void onUserDataError(String error) {
//                }
//            });
            // Now, you can use the nameUser in your HomeFragment
            // For example, you can set it to a TextView or use it as needed.
        }
        else{
            Log.d("HomeFragment", "HomeFragment: args Null");
        }


        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_home, container, false);

        // Find the TextView
        TextView welcomeTextView = view.findViewById(R.id.welcome_text);
        // Check if nameFromDB is null, and if so, show a placeholder or loading message
        if (name == null) {
            welcomeTextView.setText("Loading...");
        } else {
            welcomeTextView.setText(name);
        }
        // Find the item1_homepage view
        View item1HomepageView = view.findViewById(R.id.item1_homepage);

         //Create a SpannableStringBuilder for the

        SpannableStringBuilder spannableText = new SpannableStringBuilder("Welcome, "+name);

        // Set "Welcome" text color to black
        spannableText.setSpan(
                new ForegroundColorSpan(Color.BLACK),
                0, 7, // Start and end indices for "Welcome"
                SpannableStringBuilder.SPAN_EXCLUSIVE_EXCLUSIVE
        );

        // Set "Sourav" text color to orange
        spannableText.setSpan(
                new ForegroundColorSpan(Color.parseColor("#FFA500")), // Orange color
                8, spannableText.length(), // Start and end indices for "Sourav"
                SpannableStringBuilder.SPAN_EXCLUSIVE_EXCLUSIVE
        );

        // Set the formatted text to the TextView
        welcomeTextView.setText(spannableText);

        // Set an OnClickListener for item1_homepage view
        item1HomepageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), RentItem.class);
                startActivity(intent);
            }
        });

        return view;
    }
    public static HomeFragment newInstance(String nameUser) {
        HomeFragment fragment = new HomeFragment();
        Bundle args = new Bundle();
        args.putString("nameUser", nameUser);
        fragment.setArguments(args);
        return fragment;
    }

    public void setName(String name) {
        this.name = name;
    }
    private void retrieveUserData() {
        SharedPreferences sharedPrefs = requireActivity().getSharedPreferences("userPrefs", Context.MODE_PRIVATE);

        // Retrieve the data you stored
        name = sharedPrefs.getString("name", "");
        city = sharedPrefs.getString("city", "");
        country = sharedPrefs.getString("country", "");
        email = sharedPrefs.getString("email", "");
        phone = sharedPrefs.getString("phone", "");
        coverPhotoUrl = sharedPrefs.getString("coverPhotoUrl", "");
        profilePhotoUrl = sharedPrefs.getString("profilePhotoUrl", "");
    }
}