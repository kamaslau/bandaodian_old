<?php
	//回复消息首尾模板
	$tplStart = '<?xml version="1.0" encoding="UTF-8"?>
					<xml>
						<ToUserName><![CDATA['.$fromUsername.']]></ToUserName>
						<FromUserName><![CDATA['.$toUsername.']]></FromUserName>
						<CreateTime>'.$time.'</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>';
	$tplEnd = '			<FuncFlag>0</FuncFlag>
					</xml>';
	
	//文本消息模板
	$textTpl = "<Content><![CDATA[%s]]></Content>";
	
	//图片消息模板
	$imageTpl = "<Image>
					<MediaId><![CDATA[%s]]></MediaId>
				</Image>";
	
	//语音消息模板（必须上传）
	$voiceTpl = "<Voice>
					<MediaId><![CDATA[%s]]></MediaId>
				</Voice>";
	
	//音乐模板（可外链）
	$musicTpl = "<Music>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
					<MusicUrl><![CDATA[%s]]></MusicUrl>
					<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
					<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
				</Music>";
	
	//视频消息模板
	$videoTpl = "<Video>
					<MediaId><![CDATA[%s]]></MediaId>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
				</Video>";
	
	//图文消息模板
	$newsTpl = "<ArticleCount>%s</ArticleCount>
				<Articles>
					%s
				</Articles>";
	
	//模板引用数组
	$templates = array(
		'text' => $textTpl,
		'image' => $imageTpl,
		'voice' => $voiceTpl,
		'music' => $musicTpl,
		'video' => $videoTpl,
		'news' => $newsTpl
	);