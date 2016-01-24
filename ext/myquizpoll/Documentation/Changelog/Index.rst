

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Changelog
---------

- Version 2.4.5; 10.10.2015:

  One workspace problem solved: link to the template works now even there is only a reference to sys_file.

- Version 2.4.4; 30.5.2015:

  Bug fixed: localization in Typo3 6.
  Deprecated functions removed.
  no_cache-parameter removed.

- Version 2.4.1; 7.3.2015:

  new documentation format.

  OPT_ALL_POINTS added to Ajax-Result.

- Version 2.4.0; 24.12.2014:

  Some templates and styles changed (optimation for Bootstrap 3 and
  realURL).

  myvars.answers.input\_label 5 and 6 added (for Bootstrap 3).

- Version 2.3.4; 10.5.2014:

  Again Typo3 v.6.2 Bugfix-Release.

  ###TEMPLATE\_STAR\_RATING\_DETAILS\_ITEM### will not be used in Typo3
  6.2 (the details are fixed).

  Version 2.3.3; 10.4.2014:

- Typo3 v.6.2 Bugfix-Release.

  Version 2.3.2; 25.2.2014:

- 2 bugs fixed.

  Version 2.3.1; 20.7.2013:

- Bug with not sending an email fixed.

  Version 2.3.0; 16.7.2013:

- Keep selected answers when the captcha was wrong.

- Poll archive added. TS: cmd = archive.

- TS “pollStart” and “ignoreSubmits” added.

- New example template: template\_poll\_simplemodal.html

- Text-Emails now with the plain text of the HTML text.

- Small bug fixed with rating stars and other bug fixes.

  Version 2.2.0; 6.4.2013:

- Backend: normal statistics improved. Thanks to Marcel Utz.

- Possibility to reverse sorting order.

- TS “myVars.answers.input\_label = 2”, 3 or 4 now possible. Important
  for Bootstrap.

- TS “highscore.ignorePid” and “highscore.showUser” added.

- TS “blockIP” added.

- Now Typo3 6.0 compatible.

  Version 2.1.0; 9.2.2013:

- Some template improvements (e.g. with jokers).

- Small fix with the star-rating.

- Font-family and some colors in the default-css-file removed. Font-size
  changed.

- New TypoScript: myVars.separator.

- New HTML-examples: template\_poll\_jquery\_pie.html and
  template\_poll\_jquery\_bar.html.

- Code cleaning. This changelog shortened.

  Version 2.0.6; 5.2.2013:

- Backend module: some functions are restricted for the admin-mode.

- **Important security fix.**

  Version 2.0.0; 7.9.2012:

- New question-type added: star rating. New TS: starRatingDetails and
  alwaysShowStarRatingDetails. Thanks to Marcel Utz.

- Star rating files can be included via static typoscript.

- Possibility to hide user-results in the backend. quizpoll\_hidden
  added to backend style sheet.

- Possibility to go back, when pageQuestions>1. New TS and Flexform:
  allowBack.

- Possibility to give a default answer if a question is a text-answer.

- New layout for user data. New style sheets added.

- New example-template: template\_poll\_multipage.html.

- New TS and flexform option: hideByDefault.

- New TS: myVars.page, requireSession.

- TS “disbaleIp” renamed to “disableIp”!

Version 1.9.6; 29.7.2012:

- New TS-parameter: remoteIP.

- New template: template\_poll\_enhanced.html.

- Important change for detail answers when showing all answers; new
  marker: TEMPLATE\_DETAILS\_LINK. See tx\_myquizpoll\_pi1.html. You
  need to update your template.

- Small bugfix and some minor security fixes.

- **Important security fix** ! Thanks to Benjamin Böck, www.xsec.at

Version 1.9.0; 13.5.2012:

- New requirement: Typo3 version >= 4.3.0.

- Chapter “Markers” added in this documentation.

- New markers for ###TEMPLATE\_QUESTION\_PAGE###: ###PAGE### and
  ###MAX\_PAGES###.

- New markers for ###TEMPLATE\_POLLRESULT###: ###VAR\_QID###,
  ###VAR\_FID###, ###VAR\_RESPID###, ###VAR\_LANG### and
  ###VAR\_ANSWERS###.

- New TS-option: cookieMode = 5.

- New example templates: template\_rating\_stars1.html and
  template\_rating\_stars2.html.

- Bug fixed: “rating.parameter = id” worked only with id in the link.
  Now: uid will taken if no id was found. Foreign value implemented in
  the poll result page.

- Bug fixed: take only the newest questions in poll-mode when there are
  more questions.

- Deprecated methods replaced.

- Version 1.8.0; 12.2.2012:

- **Import** : frontend-import was out-sourced! You will need now an
  additional extension for fe-import! See chapter “Import”.

- New TS-option: userData.askAtQuestion=2. New TS-value: disableIp.

- First hook: an address can be saved into tt\_address. See example
  template template\_address.html.

- Debug output changed. Debug works now with devlog. You need an devlog-
  extension for debugging.

- Termination-sheet at the flexforms added. TS dateFormat moved to
  highscore.dateFormat.

- You can now use more than one sys-folder with questions.

- Categories: time per page added. If set, it replaces the TypoScript
  value pageTimeSeconds.

- ###VAR\_CATEGORY### and ###VAR\_NEXT\_CATEGORY### can be used in the
  highscore-list too.

- Security improvement for name and homepage.

- Example for all correct answers added to the karussell-extension.

  Version 1.7.0; 26.11.2011:

- JQuery eID for a quiz added. New example template:
  template\_quiz\_jquery.html and \_jquery2.html

- Extensions which extend myquizpoll added on my homepage. Up to 12
  questions supported in the backend evaluation. The add-on extensions
  requires this new myquizpoll version!

- New markers in TEMPLATE\_QUESTION: ###VAR\_QUESTION\_TYPE###,
  ###VAR\_QUESTION\_ANSWERS###.

- TypoScript:myVars.answers.input\_wrapnow not applicable for select-
  options.

- Security improvement for text answers!

- Small bug with the jokers fixed.

- Import: new bug fixed. Check of referrer inserted.

  Version 1.6.0; 30.04.2011:

- New TS-variables: “highscore.groupBy”, “highscore.linkTo”,
  “deleteDouble”.

- New markers: ###VAR\_PAGE\_NAME###.

- New db-field for storing the start-point of a quiz. E.g. for
  ###VAR\_PAGE\_NAME###.

- Explanation also available at the poll result page.

- Name of all highscore variables changed! Old names are still
  supported, but deprecated.

- Name of the quiz in the flexforms removed. Will now be set
  automatically; otherwise use TypoScript.

- Old deprecated variables removed!!!

  Version 1.5.0; 21.03.2011:

- Polls and ratings with jQuery-submit improved.

- The image of a question is now available at the poll result site and
  the emails too.

- New TS-variables: “deleteResults”, “randomCategories”,
  “onlyCategories”, “tableAnswers” and “allowCookieReset”. New modes for
  “debug” and “cookieMode”.

- Default value for userSession set to 1.

- Update script added to copy basic poll data to the new voting table
  (optional).

- SecondPollMode=1 works now for all modes of double entry check.

- Using of t3lib\_mail\_Message for sending emails if Typo3 version >=
  4.5.0.

- Bug fixed: don't send emails at a second visit.

  Version 1.4.0; 28.01.2011:

- Users can be hidden at any time in the front-end.

- Rating / voting: table and jQuery example added. Submit with jQuery is
  now possible!

- Bug fixed: Error when showing a french error message.

- Bug fixed: Fatal error under Typo3 4.3.x.

  Version 1.3.0; 08.11.2010:

- New TS-variable: “mixAnswers” and “secondPollMode”.

- “useCookiesInDays” can now be -1. -1 means: the cookie expires when
  closing the browser.

- “general\_stdWrap.notForAnswers” added. Its the possibility to use the
  parseFunc only for RTE-fields.

- ###VAR\_QUESTION\_NUMBER### added: number of the question at a page.

- New method to get the real IP address.

- Now with up to 6 answers!

- Possibility to hide data in the highscore list. See FAQ. Therefore the
  hidden-field is now ignored while checking for second entry.

- High score list: you can select more than one folder via
  startingpoint. ###VAR\_FOLDER\_NAME### added to display the selected
  folder names.

- Basic poll result site: is not ignoring the start category.

- Basic poll result site: jQuery example and ###VAR\_COUNT###,
  ###VAR\_SELECTED### added.

- Advanced poll: template\_poll\_advanced-example changed.
  ###VAR\_QA\_NR### added.

- Bug fixed: asking for captchas on the final page. EnableCaptcha=2 is
  now obsolete.

- Bug fixed: fe\_usersName was ignored.

  Version 1.2.3; 10.05.2010:

- New: support of the extension picasaimagebrowser.

- New: wrap of yes-no-boxes with span and the classes
  tx\_myquizpoll\_pi1-yesno, -yes and -no.

- Check if uploaded files are images (otherwise delete them).

- 3 deprecated PHP-functions replaced.

- Bug fixed: #### replaced by ### in many templates.

  Version 1.2.0; 25.04.2010:

- Hiding of titles via stylesheets possible:
  ###PREFIX###-title###TITLE\_HIDE### →tx\_myquizpoll\_pi1-title-hide

- TS-variable “showCategoryElement”, selectable content element at
  categories and template ###TEMPLATE\_CATEGORY\_ELEMENT###.

- More languages added: Italian, Spanish and Romanian. Furthermore empty
  language-arrays added.

- Front-end import possible. See chapter “Import”.

- CSV-export added. See chapter “Export”.

- TS-variable “fe\_usersName”.

- TS-variable “showDetailAnswers” and templates TEMPLATE\_DETAILS,
  TEMPLATE\_DETAILS\_ITEM.

- TS-variable “noAnswer”. New method for the “correct/false answered
  questions” list. See chapter “all about scores and the correct-
  checkbox”.

- Debug outputs are now visible.

  Version 1.1.0; 18.02.2010:

- 2 new question types added (text-area and text-comment).

- New scores-handling for “noNegativePoints>=3”. Read chapter “All about
  scores”.

- Enforce selection via TS-value “enforceSelection”.

- New TS-variable “loggedInMode” and“cookieMode”.

- You can save user results now into another folder than the questions.
  TS-variable: “resultsPID”.

- Possibility to show only all correct answered or only the not correct
  answered questions on the final page. 2 new db-fields and 3 marker for
  correct/false answered questions: VAR\_QUESTIONS\_CORRECT,
  VAR\_QUESTIONS\_FALSE and VAR\_QUESTIONS\_ANSWERED.

- CSV-Import via backend-module.

- Debug mode now available.

- general\_stdWrap added to the default settings.

- Update script: you can convert basic poll data to advanced poll
  (normal mode) data (if you want).

- Bug fixed: missing flexform-values in the helper-class.

  Version 1.0.1; 10.01.2010:

- Bug fixed: startCategory works now with pageQuestions>1 too.

- Bug fixed: dontShowPoints doesn´t disable advanced statistics anymore.

- Bug fixed: decimal digit 0 as answer will not longer be ignored.

  Version 1.0.0; 29.12.2009:

- **Important** database improvements. You :underline:`need` to update
  your database! See chapter “How to update”.

- New feature: now you can send an email to the admin or the quiz taker
  after finishing a quiz/poll.

- New feature: categories added. You can define, which category the next
  question must have.

- New backend module: view and delete user results; statistics.

- New TS-variable: “showEvaluation”. See TS reference.

- New markers for ###TEMPLATE\_POLL\_SUBMITED###.

- ###MY\_INPUT\_ID### and ###MY\_INPUT\_LABEL### added. See chapter
  “Your own variables”.

- Versioning added.

- Final page shows only the answered questions (if
  “showAllCorrectAnswers=1”).

- Example-templates to an example-folder moved.

- Minor bugs fixed and other minor features added. E.g. Parsing of
  questions and explanations.

- Bug: reload problem with useCookiesInDays and pageQuestions=0 (e.g.
  poll) fixed.

- Bug: wrong result for ###REF\_QR\_ANSWER\_CORR### fixed.

