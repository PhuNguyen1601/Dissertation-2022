from flask import Flask, jsonify, request, send_file, url_for
from werkzeug.datastructures import FileStorage
from yolo_detection_video_test import TestVideo
from flask_cors import CORS, cross_origin
from werkzeug.utils import secure_filename
import os
import pprint


UPLOAD_FOLDER = 'D: \laragon\www\Demo-LV\Luanvan\public\videos'
ALLOWED_EXTENSIONS = {'mp4'}

app = Flask(__name__)
CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER


@app.route('/predict', methods=['GET', 'POST'])
@cross_origin(origin='*')
def predict():
    if request.method == 'POST':
        path = 'D:\laragon\www\Demo-LV\Luanvan\public\\videos\\'
        filename = path + request.json['file']
        video = TestVideo(filename)

    return jsonify(video)


if __name__ == '__main__':
    app.run(host='127.0.0.1', port='8081')
