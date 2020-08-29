<?php
//if($_result.result == 'ok'){
//
//}else{
//echo "문자전송에 실패하였습니다";
//}


/*
 * 뿌리오 발송API 경로 - 서버측 인코딩과 응답형태에 따라 선택
 */
$_api_url = 'https://message.ppurio.com/api/send_utf8_json.php';     // UTF-8 인코딩과 JSON 응답용 호출 페이지
// $_api_url = 'https://message.ppurio.com/api/send_utf8_xml.php';   // UTF-8 인코딩과 XML 응답용 호출 페이지
// $_api_url = 'https://message.ppurio.com/api/send_utf8_text.php';  // UTF-8 인코딩과 TEXT 응답용 호출 페이지
// $_api_url = 'https://message.ppurio.com/api/send_euckr_json.php'; // EUC-KR 인코딩과 JSON 응답용 호출 페이지
// $_api_url = 'https://message.ppurio.com/api/send_euckr_xml.php';  // EUC-KR 인코딩과 XML 응답용 호출 페이지
// $_api_url = 'https://message.ppurio.com/api/send_euckr_text.php'; // EUC-KR 인코딩과 TEXT 응답용 호출 페이지


/*
 * 요청값
 */


$_param['userid'] = 'app0';           // [필수] 뿌리오 아이디
$_param['callback'] = '01092799721';    // [필수] 발신번호 - 숫자만
$_param['phone'] = '01051187828';       // [필수] 수신번호 - 여러명일 경우 |로 구분 '010********|010********|010********'
$_param['msg'] = '테스트 발송입니다';   // [필수] 문자내용 - 이름(names)값이 있다면 [*이름*]가 치환되서 발송됨
//$_param['names'] = '최연진';            // [선택] 이름 - 여러명일 경우 |로 구분 '홍길동|이순신|김철수'
//$_param['appdate'] = '20200826';  // [선택] 예약발송 (현재시간 기준 10분이후 예약가능)
//$_param['subject'] = '테스트';          // [선택] 제목 (30byte)
//$_param['file1'] = '@이미지파일경로;type=image/jpg'; // [선택] 포토발송 (jpg, jpeg만 지원  300 K  이하)

$_curl = curl_init();
curl_setopt($_curl, CURLOPT_URL, $_api_url);//URL 지정하기
curl_setopt($_curl, CURLOPT_POST, true); //0이 default 값이며 POST 통신을 위해 1로 설정해야 함
curl_setopt($_curl, CURLOPT_SSL_VERIFYPEER, false); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// REQUEST 에 대한 결과값을 받을 건지 체크 Resource ID 형태로 넘어옴 :: 내장 함수 curl_errno 로 체크
curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($_curl, CURLOPT_POSTFIELDS, $_param);// Post 값 Get 방식처럼적는다.
$_result = curl_exec($_curl);
curl_close($_curl);

$_result = json_decode($_result);

/*
 * 응답값
 *
 *  <성공시>
 *    result : 'ok'                           - 전송결과 성공
 *    type   : 'sms'                          - 단문은 sms 장문은 lms 포토문자는 mms
 *    msgid  : '123456789'                    - 발송 msgid (예약취소시 필요)
 *    ok_cnt : 1                              - 발송건수
 *
 *  <실패시>
 *    result : 'invalid_member'               - 연동서비스 신청이 안 됐거나 없는 아이디
 *    result : 'under_maintenance'            - 요청시간에 서버점검중인 경우
 *    result : 'allow_https_only'             - http 요청인 경우
 *    result : 'invalid_ip'                   - 등록된 접속가능 IP가 아닌 경우
 *    result : 'invalid_msg'                  - 문자내용에 오류가 있는 경우
 *    result : 'invalid_names'                - 이름에 오류가 있는 경우
 *    result : 'invalid_subject'              - 제목에 오류가 있는 경우
 *    result : 'invalid_sendtime'             - 예약발송 시간에 오류가 있는 경우 (10분이후부터 다음해말까지 가능)
 *    result : 'invalid_sendtime_maintenance' - 예약발송 시간에 서버점검 예정인 경우
 *    result : 'invalid_phone'                - 수신번호에 오류가 있는 경우
 *    result : 'invalid_msg_over_max'         - 문자내용이 너무 긴 경우
 *    result : 'invalid_callback'             - 발신번호에 오류가 있는 경우
 *    result : 'once_limit_over'              - 1회 최대 발송건수 초과한 경우
 *    result : 'daily_limit_over'             - 1일 최대 발송건수 초과한 경우
 *    result : 'not_enough_point'             - 잔액이 부족한 경우
 *    result : 'over_use_limit'               - 한달 사용금액을 초과한 경우
 *    result : 'server_error'                 - 기타 서버 오류
 */

print_r($_result);



