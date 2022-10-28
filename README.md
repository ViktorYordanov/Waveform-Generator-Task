# Waveform Generator Task

## the task:

Write a program to consume the raw output from an audio silence detection [filter](https://ffmpeg.org/ffmpeg-filters.html#silencedetect) and convert it into a useful format for consumption by other APIs. The `ffmpeg` command has been run for a sample call and we've linked the raw data for both the [`user` channel](https://github.com/jiminny/join-the-team/blob/master/assets/user-channel.txt), and the [`customer` channel](https://github.com/jiminny/join-the-team/blob/master/assets/customer-channel.txt).

The files contain data about a real conversation between two parties on a conference call with the following structure:

```
[silencedetect @ 0x7fa7edd0c160] silence_start: 1.84
[silencedetect @ 0x7fa7edd0c160] silence_end: 4.48 | silence_duration: 2.64
[silencedetect @ 0x7fa7edd0c160] silence_start: 26.928
```
## How to run:

1. Change the value of the "BASE_URL" constant in "constants.php" to match the endpoint of this project (i.e. 'http://localhost')
2. Use Postman to send POST request to the same endpoint with Header `Content-Type` set to `application/json` and set the Body as `form-data` whith 2 parameters:
- user_channel - file with the user silence detection output
- customer_channel - file with customer silence detection output