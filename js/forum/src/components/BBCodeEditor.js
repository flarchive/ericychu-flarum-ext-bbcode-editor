import listItems from 'flarum/helpers/listItems';
import TextEditor from 'flarum/components/TextEditor';
import sceditor from 'flarum/bbcode-editor/sceditor';
import 'flarum/bbcode-editor/sceditor/formats/bbcode';
import style from 'flarum/bbcode-editor/sceditor/style';

export default class BBCodeEditor extends TextEditor {
  init() {
    this.value = m.prop(this.props.value || '');
    this.editor = null;
  }

  view() {
    const classNames = 'Composer-flexible ' + this.props.className;
    return (
      <div className="TextEditor">
        <div className={classNames}>
                  <textarea
                    config={this.configTextarea.bind(this)}
                    oninput={m.withAttr('value', this.oninput.bind(this))}
                    placeholder={this.props.placeholder || ''}
                    value={this.value()}/>
        </div>
        <ul className="TextEditor-controls Composer-footer">
          {listItems(this.controlItems().toArray())}
        </ul>
      </div>
    );
  }

  configTextarea(element, isInitialized) {
    if (this.editor !== null) {
      this.editor.focus();
    }

    if (isInitialized) return;

    if (this.editor !== null) {
      this.editor.destroy();
    }

    sceditor.create(element, {
      format: 'bbcode',
      width: '100%',
      height: '100%',
      enablePasteFiltering: true,
      style: style,
      emoticonsEnabled: false,
      spellcheck: false,
      resizeHeight: false,
      resizeWidth: false,
      resizeEnabled: false,
      toolbar: 'bold,italic,underline,strike,subscript,superscript,size,color,|,' +
      'left,center,right,justify,bulletlist,orderedlist,|,' +
      'table,code,quote,horizontalrule,|,' +
      'link,unlink,email,image,|,' +
      'removeformat',
    });

    this.editor = sceditor.instance(element);

    this.editor.val(this.value());

    const valHandler = function handler() {
      const value = this.editor.val();
      if (this.value() != value) {
        this.setValue(value);
      }
    };

    this.editor.bind('nodechanged', valHandler.bind(this));
    this.editor.bind('valuechange', valHandler.bind(this));
    this.editor.bind('selectionchanged', valHandler.bind(this));
    this.editor.bind('keyup', valHandler.bind(this));

    this.editor.focus();

    const handler = () => {
        this.onsubmit();
        m.redraw();
    };

    $(element).bind('keydown', 'meta+return', handler);
    $(element).bind('keydown', 'ctrl+return', handler);
  }

  insertAtCursor(value) {
    if (this.editor !== null) {
      this.editor.insert(value);
    }
  }
}
