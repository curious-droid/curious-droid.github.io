---
layout: default
---

<?php
require('Persistence.php');
$comment_post_ID = 1;
$db = new Persistence();
$comments = $db->get_comments($comment_post_ID);
$has_comments = (count($comments) > 0);
?>

<article class="post detailed">
  <h1>{{ page.title }}</h1>

  <div>
    <p class="author_title">{{site.author}}  ·  {{ page.date | date: "%B %e, %Y" }}</p>
    {% if page.last_modified_at %}
    <p class="author_title" datetime="{{ page.last_modified_at | date_to_xmlschema }}">(Updated: {{ page.last_modified_at | date: "%b %-d, %Y" }})</p>
    {% endif %}
    <div class="post-tags">
      {% if post %}
        {% assign categories = post.categories %}
      {% else %}
        {% assign categories = page.categories %}
      {% endif %}
      {% for category in categories %}
        <a href="{{site.baseurl}}/categories/#{{category|slugize}}">{{category}}</a>
        {% unless forloop.last %}&nbsp;{% endunless %}
      {% endfor %}
    </div>
  </div>
    
  <div class="entry">
    {{ content }}
  </div>

  <div id="respond">

<h2>Comments</h2>

<ol id="posts-list" class="hfeed<?php echo($has_comments?' has-comments':''); ?>">
  <li class="no-comments">Be the first to add a comment.</li>
  <?php
    foreach ($comments as $comment) {
      ?>
      <li><article id="comment_<?php echo($comment['id']); ?>" class="hentry">
        <footer class="post-info">
          <abbr class="published" title="<?php echo($comment['date']); ?>">
            <?php echo( date('d F Y', strtotime($comment['date']) ) ); ?>
          </abbr>

          <address class="vcard author">
            By <a class="url fn" href="#"><?php echo($comment['comment_author']); ?></a>
          </address>
        </footer>

        <div class="entry-content">
          <p><?php echo($comment['comment']); ?></p>
        </div>
      </article></li>
      <?php
    }
  ?>
</ol>

    <h3>Leave a Comment</h3>
  
    <form action="post_comment.php" method="post" id="commentform">
  
      <label for="comment_author" class="required">Your name</label>
      <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">
  
      <label for="email" class="required">Your email;</label>
      <input type="email" name="email" id="email" value="" tabindex="2" required="required">
  
      <label for="comment" class="required">Your message</label>
      <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
  
      <!-- comment_post_ID value hard-coded as 1 -->
      <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
      <input name="submit" type="submit" value="Submit comment" />
  
    </form>
  </div>

  <div>
    <p><span class="share-box">Share:</span> <a href="http://twitter.com/share?text={{ page.title }}&url={{site.url}}{{page.url}}" target="_blank">Twitter</a>, <a href="https://www.facebook.com/sharer.php?u={{site.url}}{{page.url}}" target="_blank">Facebook</a></p>
  </div>

  <!--<div class="date">
    Written on {{ page.date | date: "%B %e, %Y" }}
  </div>-->

  {% include disqus.html %}
</article>
