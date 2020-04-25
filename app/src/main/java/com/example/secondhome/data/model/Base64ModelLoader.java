package com.example.secondhome.data.model;


import androidx.annotation.Nullable;

import com.bumptech.glide.load.Options;
import com.bumptech.glide.load.model.ModelLoader;

import java.nio.ByteBuffer;

public final class Base64ModelLoader implements ModelLoader<String, ByteBuffer> {

        @Nullable
        @Override
        public ModelLoader.LoadData<ByteBuffer> buildLoadData(String model, int width, int height, Options options) {
            return null;
        }

        @Override
        public boolean handles(String model) {
            return false;
        }
}
