<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for submitting your video!</title>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#fff;">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0"
                        style="border-radius:20px;background:#F8F8F8;width: 700px; padding-top: 25px; padding-bottom: 40px;  margin: 0 auto; padding: 30px;">
                        <tbody>
                            <tr>
                                <td colspan="4" valign="top"
                                    style="text-align: left; font-weight: 500; color: #000; padding-bottom: 5px; padding-top: 20px;">
                                    <div style="margin-bottom:8px">Dear {{ $video->first_name . ' ' . $video->last_name }}</div>
                                    <div style="color:#6D6D6D;line-height: 24px; font-weight: 400;">
                                        We are pleased to inform you that your video has been successfully submitted to
                                        mototubesubmission. <br>
                                        Your content shall be reviewed shortly, and our team might reach out if more
                                        information is needed.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="top"
                                    style="text-align: left; font-weight: 500; color: #000; padding-bottom: 5px; padding-top: 20px;">
                                    <div style="">Submitted Work:</div>
                                    <div style="color:#6D6D6D;line-height: 24px; font-weight: 400;">
                                        - Video URL: {{ $video->video_url ? $video->video_url : 'N\A' }} <br>
                                        - Video Title: {{ $video->title }}<br>
                                        - Video Description: {{ $video->description }}<br>
                                        - Content uploaded to our server link:
                                        {{ Storage::disk('public')->url($video->video) }}<br>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="top"
                                    style="text-align: left; font-weight: 500; color: #000; padding-bottom: 5px; padding-top: 20px;">
                                    <div style="">Submission Details:</div>
                                    <div style="color:#6D6D6D;line-height: 24px; font-weight: 400;">
                                        - Submitted on: {{ $video->created_at->format('M d, Y') }} at {{ $video->created_at->format(' H:i:s') }} UTC <br>
                                        - Terms of Service: Agreed <br>
                                        - Terms of Submission: Agreed | Exclusive License
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="top"
                                    style="text-align: left; font-weight: 500; color: #000; padding-bottom: 5px; padding-top: 20px;">
                                    <div style="color:#6D6D6D;line-height: 24px; font-weight: 400;">
                                        For further assistance, you can contact us at <a href="mailto:support@viralsnare.com">support@viralsnare.com</a>.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="top"
                                    style="text-align: left; font-weight: 500; color: #000; padding-bottom: 5px; padding-top: 20px;">
                                    <div style="color:#6D6D6D;line-height: 24px; font-weight: 400;">
                                        Kind regards, <br>
                                        Team ViralSnare
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
