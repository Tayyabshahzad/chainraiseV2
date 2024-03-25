const Ziggy = {"url":"http:\/\/chain-clone.test","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"auth.user.login":{"uri":"api\/auth\/login","methods":["POST"]},"auth.user.register":{"uri":"api\/auth\/register","methods":["POST"]},"user.investors":{"uri":"api\/users\/investors","methods":["GET","HEAD"]},"user.investor.create":{"uri":"users\/investor\/create","methods":["GET","HEAD"]},"user.issuer.create":{"uri":"users\/issuer\/create","methods":["GET","HEAD"]},"user.save":{"uri":"users\/issuer\/save","methods":["POST"]},"user.profile":{"uri":"users\/profile","methods":["GET","HEAD"]},"user.list":{"uri":"users\/list","methods":["GET","HEAD"]},"user.update":{"uri":"users\/update","methods":["POST"]},"user.delete":{"uri":"users\/delete","methods":["POST"]},"organizations.index":{"uri":"organizations\/listing","methods":["GET","HEAD"]},"organizations.offers.edit":{"uri":"api\/organizations\/listing\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"organizations.offers":{"uri":"api\/organizations\/{id}\/offers","methods":["GET","HEAD"],"parameters":["id"]},"offers.offers":{"uri":"api\/offers\/listing","methods":["GET","HEAD"]},"offers.offers.edit":{"uri":"api\/offers\/listing\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"api.offer-listing":{"uri":"sppx\/listing","methods":["GET","HEAD"]},"api.offer-details":{"uri":"sppx\/details\/{uid?}","methods":["GET","HEAD"],"parameters":["uid"]},"api.invest-now":{"uri":"sppx\/invest-now","methods":["POST"]},"api.investor.certification":{"uri":"sppx\/investor-certification","methods":["GET","HEAD"]},"api.profile":{"uri":"sppx\/profile","methods":["GET","HEAD"]},"api.profile.update":{"uri":"sppx\/profile-update","methods":["POST"]},"api.loginApi":{"uri":"sppx\/api-login","methods":["POST"]},"api.log.out":{"uri":"sppx\/api-logout","methods":["GET","HEAD"]},"api.check.auth":{"uri":"sppx\/check-auth","methods":["GET","HEAD"]},"api.registerApi":{"uri":"sppx\/api-register","methods":["POST"]},"api.register.api.user":{"uri":"sppx\/register\/user","methods":["POST"]},"api.setup.accreditation":{"uri":"sppx\/setup-accreditation\/{uuid?}","methods":["GET","HEAD"],"parameters":["uuid"]},"api.save.accreditation":{"uri":"sppx\/setup-accreditation","methods":["POST"]},"api.certify.Url":{"uri":"sppx\/certifyUrl","methods":["POST"]},"api.pledge":{"uri":"sppx\/pledge\/{uuid?}","methods":["GET","HEAD"],"parameters":["uuid"]},"api.pledge.submit":{"uri":"sppx\/pledge\/submit","methods":["POST"]},"api.pledge.portfolio":{"uri":"sppx\/pledge\/portfolio","methods":["GET","HEAD"]},"user.setup":{"uri":"setup","methods":["GET","HEAD"]},"king2":{"uri":"ki","methods":["GET","HEAD"]},"mailTrap":{"uri":"mailTrap","methods":["GET","HEAD"]},"messss":{"uri":"message","methods":["GET","HEAD"]},"dummer":{"uri":"dummer","methods":["GET","HEAD"]},"error.logs":{"uri":"logs","methods":["GET","HEAD"]},"login.social":{"uri":"login-social","methods":["GET","HEAD"]},"otp":{"uri":"otp","methods":["GET","HEAD"]},"login.google":{"uri":"login\/google","methods":["GET","HEAD"]},"login.facebook":{"uri":"login\/facebook","methods":["GET","HEAD"]},"index":{"uri":"\/","methods":["GET","HEAD"]},"consultation":{"uri":"consultation","methods":["GET","HEAD"]},"marketplace":{"uri":"marketplace","methods":["GET","HEAD"]},"offer.details":{"uri":"offer\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"offer.details.v2":{"uri":"offer\/v2\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"faq":{"uri":"faq","methods":["GET","HEAD"]},"privacy.policy":{"uri":"privacy-policy","methods":["GET","HEAD"]},"investors":{"uri":"investors","methods":["GET","HEAD"]},"businesses":{"uri":"businesses","methods":["GET","HEAD"]},"flow_chart":{"uri":"flow-chart","methods":["GET","HEAD"]},"blockchain":{"uri":"block-chain","methods":["GET","HEAD"]},"contact":{"uri":"contact","methods":["GET","HEAD"]},"offers.sort":{"uri":"offers\/sort\/{order?}","methods":["GET","HEAD"],"parameters":["order"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"my.account":{"uri":"account","methods":["GET","HEAD"]},"my.account.update":{"uri":"account\/update","methods":["POST"]},"my.documents":{"uri":"documents","methods":["GET","HEAD"]},"my.portfolio":{"uri":"portfolio","methods":["GET","HEAD"]},"investment.verify_identity":{"uri":"verify_identity","methods":["POST"]},"post.offer.question":{"uri":"post\/offer\/question","methods":["POST"]},"invest.make":{"uri":"invest\/make","methods":["GET","HEAD"]},"invest.submit":{"uri":"invest\/submit","methods":["GET","HEAD"]},"invest.step.two":{"uri":"invest\/step\/two","methods":["GET","HEAD"]},"invest.check.kyc":{"uri":"invest\/check\/kyc","methods":["GET","HEAD"]},"invest.step.three":{"uri":"invest\/step\/three","methods":["GET","HEAD"]},"invest.step.four":{"uri":"invest\/step\/four","methods":["GET","HEAD"]},"invest.step.five":{"uri":"invest\/step\/five","methods":["GET","HEAD"]},"invest.step.six.e.template":{"uri":"invest\/step\/six\/e\/template","methods":["GET","HEAD"]},"invest.save":{"uri":"invest\/save","methods":["POST"]},"invest.detail":{"uri":"invest\/details\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"invest.kyc.submit":{"uri":"invest\/submit-kyc","methods":["POST"]},"invest.verify.identity":{"uri":"invest\/verify-identity","methods":["GET","HEAD"]},"invest.investment.limits":{"uri":"invest\/investment-limits","methods":["GET","HEAD"]},"invest.payment.method":{"uri":"invest\/payment-method","methods":["GET","HEAD"]},"invest.connect.bank":{"uri":"invest\/connect-bank","methods":["GET","HEAD"]},"invest.sign.subscription":{"uri":"invest\/sign-subscription","methods":["GET","HEAD"]},"invest.get.template":{"uri":"invest\/get\/template","methods":["POST"]},"invest.get.widget.url":{"uri":"invest\/get\/widget\/url","methods":["GET","HEAD"]},"invest.get.wire":{"uri":"invest\/get\/wire","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"role.index":{"uri":"roles\/index","methods":["GET","HEAD"]},"role.save":{"uri":"roles\/create","methods":["POST"]},"payment.ach":{"uri":"users\/ach","methods":["POST"]},"user.index":{"uri":"users\/index","methods":["GET","HEAD"]},"user.email.log":{"uri":"users\/email\/logs","methods":["GET","HEAD"]},"user.childs":{"uri":"users\/get-childs","methods":["GET","HEAD"]},"user.details":{"uri":"users\/details\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"user.issuer.account.update":{"uri":"users\/accountUpdate","methods":["POST"]},"user.status.update":{"uri":"users\/update\/status","methods":["POST"]},"user.upload.documents":{"uri":"users\/upload\/document","methods":["POST"]},"user.child.save":{"uri":"users\/save","methods":["POST"]},"user.child.details":{"uri":"users\/get-child-details","methods":["POST"]},"user.child.update":{"uri":"users\/update-child","methods":["POST"]},"user.invesment.update":{"uri":"users\/invesment\/update","methods":["POST"]},"user.child.delete":{"uri":"users\/delete-child","methods":["POST"]},"user.kyc.check":{"uri":"users\/check\/kyc","methods":["POST"]},"user.re.run.kyc.level":{"uri":"users\/check\/kyc\/level","methods":["POST"]},"user.kyc.re.run":{"uri":"users\/re\/run\/kyc","methods":["POST"]},"user.kyc.document.update":{"uri":"users\/kyc\/document\/update","methods":["POST"]},"user.account":{"uri":"users\/account","methods":["GET","HEAD"]},"user.esign.template":{"uri":"users\/esign-template","methods":["GET","HEAD"]},"user.esign.template.save":{"uri":"users\/esign-template-save","methods":["POST"]},"user.update.user.status":{"uri":"users\/status\/update\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"user.update.kyc.check":{"uri":"users\/kyc\/check\/update\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"user.basic.details.update":{"uri":"users\/basic\/details\/update","methods":["POST"]},"user.info.update.trust.setting":{"uri":"users\/info\/update\/trust\/setting","methods":["POST"]},"user.info.update.document":{"uri":"users\/info\/upload\/document","methods":["POST"]},"user.info.e.document":{"uri":"users\/info\/e\/document","methods":["POST"]},"user.info.invite.email":{"uri":"users\/info\/invite\/email","methods":["POST"]},"user.info.csv":{"uri":"users\/info\/export-csv","methods":["GET","HEAD"]},"accreditation.update":{"uri":"update","methods":["POST"]},"offers.active.index":{"uri":"offers\/active\/listing","methods":["GET","HEAD"]},"offers.inactive.index":{"uri":"offers\/inactive\/listing","methods":["GET","HEAD"]},"offers.create":{"uri":"offers\/create","methods":["GET","HEAD"]},"offers.list":{"uri":"offers\/list","methods":["GET","HEAD"]},"offers.save":{"uri":"offers\/save","methods":["POST"]},"offers.delete":{"uri":"offers\/delete","methods":["POST"]},"offers.summary.delete":{"uri":"offers\/delete\/offer\/summary","methods":["POST"]},"offers.delete.faq":{"uri":"offers\/delete\/faq","methods":["POST"]},"offers.tile.delete":{"uri":"offers\/tile\/delete","methods":["GET","HEAD"]},"offers.video.delete":{"uri":"offers\/video\/delete","methods":["GET","HEAD"]},"offers.document.delete":{"uri":"offers\/document\/delete","methods":["GET","HEAD"]},"offers.update.delete":{"uri":"offers\/update\/delete","methods":["GET","HEAD"]},"offers.document.update":{"uri":"offers\/document\/update","methods":["GET","HEAD"]},"offers.edit":{"uri":"offers\/edit\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"offers.view":{"uri":"offers\/view\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"offers.update":{"uri":"offers\/update","methods":["POST"]},"offers.check.custodial":{"uri":"offers\/check\/custodial","methods":["POST"]},"offers.policy":{"uri":"offers\/policy","methods":["GET","HEAD"]},"offers.policy.create":{"uri":"offers\/policy\/create","methods":["POST"]},"offers.policy.delete":{"uri":"offers\/policy\/delete","methods":["POST"]},"offers.qa.session":{"uri":"offers\/qa","methods":["GET","HEAD"]},"offers.view.question":{"uri":"offers\/view\/question\/{offerId}","methods":["GET","HEAD"],"parameters":["offerId"]},"offers.update.question":{"uri":"offers\/question\/update","methods":["POST"]},"offers.delete.question":{"uri":"offers\/question\/delete","methods":["GET","HEAD"]},"offers.slider.image.delete":{"uri":"offers\/media\/delete","methods":["GET","HEAD"]},"organizations.create":{"uri":"organizations\/create","methods":["POST"]},"organizations.update":{"uri":"organizations\/update","methods":["POST"]},"organizations.delete":{"uri":"organizations\/delete","methods":["POST"]},"folder.create":{"uri":"folder\/create","methods":["POST"]},"folder.upload.file":{"uri":"folder\/upload-file","methods":["POST"]},"folder.get.files":{"uri":"folder\/get-files","methods":["GET","HEAD"]},"transaction.index":{"uri":"transaction","methods":["GET","HEAD"]},"transaction.delete":{"uri":"transaction\/transaction\/delete","methods":["GET","HEAD"]},"engagments.index":{"uri":"engagments","methods":["GET","HEAD"]},"esignature.preview.document":{"uri":"esignature\/preview\/document","methods":["GET","HEAD"]},"esignature.preview.document.invester.flow":{"uri":"esignature\/preview\/document\/invester\/flow\/{user_id}\/{template_id}","methods":["GET","HEAD"],"parameters":["user_id","template_id"]},"esignature.check.esing.status":{"uri":"esignature\/check\/esing\/status","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.update":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
