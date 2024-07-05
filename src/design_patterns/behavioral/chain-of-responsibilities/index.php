<?php
//  This is a behavioral design pattern that lets you pass requests along a chain of handlers. 
//  Upon receiving a request, each handler decides either to process the request or to pass it to the next handler in the chain.

//  This pattern is usually used by "middlewares" 

//  Examples

//  You need to run a chain of checks like authentication, authorization, form validation before acting on a request. The request can break at any stage if criteria is not met