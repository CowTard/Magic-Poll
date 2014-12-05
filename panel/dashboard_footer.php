    <div class="push"></div>
    </div>
    
    <!-- Modal for contact form -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalform" aria-hidden="true" id="modalform">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Don't be too harsh on us. We are trying each day to improve this site.</h4>
          </div>
          <form id="contact-form">
             <div class="modal-body">
              <div class="form-group">
                <label for="name">Name</label>                      
                <input id="name" type="text" class="form-control" placeholder="Your name" name="name" required/>
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>                     
                <input id="subject" type="text" class="form-control" placeholder="Brief description of your message" name="subject" required/>
              </div>
              <div class="form-group">
                <label for="email">Email address</label>                        
                <input id="email" type="text" class="form-control" placeholder="Your email address" name="email" required/>
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                  <textarea class="form-control" placeholder="Your message here..." name="message" id="message"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right">Send It!</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="footer">
       <div class="container">
        <p class="text-center"><a data-toggle="modal" data-target="#modalform" href="#">[Support]</a>
        <p class="text-center">© MagicPoll 2014 <a href="www.fe.up.pt">MIEIC@FEUP</a></p>
       </div>
    </div>
    
    <script src="../script/jquery-1.11.1.min.js"></script>
    <script src="../script/sweet-alert.js"></script> 
    <script src="../script/dashboard.js"></script>
    <script src="../script/jsapi-google.js"></script>
    <script src="../script/gpie.js"></script>
    <script src="../script/bootstrap.min.js"></script>
  </body>
</html>
