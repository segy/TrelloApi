<?php
/**
 * Application key
 * @link https://trello.com/1/appKey/generate
 */
Configure::write('TrelloApi.key', '');
/**
 * Application secret
 * @link https://trello.com/1/appKey/generate
 */
Configure::write('TrelloApi.secret', '');

/**
 * API URL without trailing slash
 */
Configure::write('TrelloApi.url', 'https://api.trello.com');
/**
 * API version number
 */
Configure::write('TrelloApi.version', '1');
/**
 * OAuth request token URL
 */
Configure::write('TrelloApi.requestTokenUri', 'https://trello.com/1/OAuthGetRequestToken');
/**
 * OAuth authorization URL (use %s for request token key)
 */
Configure::write('TrelloApi.authorizeUri', 'https://trello.com/1/OAuthAuthorizeToken?oauth_token=%s&expiration=never&scope=read,write');
/**
 * OAuth access token URL
 */
Configure::write('TrelloApi.accessTokenUri', 'https://trello.com/1/OAuthGetAccessToken');
