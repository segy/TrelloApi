<?php
/**
 * Application key
 * @link https://trello.com/1/appKey/generate
 */
Configure::write('TrelloApi.key', '34113948641f6d5b57db6177eed03c0f');
/**
 * Application secret
 * @link https://trello.com/1/appKey/generate
 */
Configure::write('TrelloApi.secret', '6a4eee55b9fdcfc83028fa03739a5cf66602f25001cc9e24fbdfea4eb747eba1');

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
