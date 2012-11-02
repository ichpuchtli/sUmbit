<li><em>PHP Version: </em><strong><?php echo $stats['PHP Configuration']['PHP Version']; ?></strong></li>
<li><em>Server OS: </em><strong><?php echo $stats['Environment']['OS']; ?></strong></li>
<li><em>File Uploads: </em><strong><?php echo $stats['PHP Core']['file_uploads']; ?></strong></li>
<li><em>Upload Max Filesize: </em><strong><?php echo $stats['PHP Core']['upload_max_filesize']; ?></strong></li>
<li><em>FTP Support: </em><strong><?php echo $stats['ftp']['FTP support']; ?></strong></li>
<li><em>#Articles: </em><strong><?php echo $Articles; ?></strong></li>
<li><em>#Categories: </em><strong><?php echo $Categories; ?></strong></li>
<li><em>#Comments: </em><strong><?php echo $Comments; ?></strong></li>
<li><em>#Members: </em><strong><?php echo $Users; ?></strong></li>
<li><em>#Administrators: </em><strong><?php echo $Admins; ?></strong></li>
<li><em>#Users Online: </em><strong><?php echo $guests; ?></strong></li>